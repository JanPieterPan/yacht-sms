<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Mail\CredentialsMail;
use App\Models\Data;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    /**
     * Middleware.
     */
    public function __construct()
    {
        $this->middleware('client', ['only' => ['show']]);
        $this->middleware('admin', ['except' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = User::where('type', 'client')->orderBy('name')->paginate(10);
        return view('dashboard.clients.list', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'subdomain' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'avatar' => 'image',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 'client',
            'company' => 0,
            'subdomain' => $request->subdomain,
            'bg_color' => $request->bg_color,
            'text_color' => $request->text_color,
            'welcome_text' => $request->welcome_text,
        ];

        if($request->hasFile('avatar')) {
            $folder = date('Y-m');
            $data['avatar'] = $request->file('avatar')->store("{$folder}");
        }

        $user = User::create($data);
        $loginUrl = getProtocol() . getDomain() . '/login';

        $credentials = "
            Your account on WE Management have successfully created.
            <hr>
            <div>
                URL: <a href='$loginUrl'>WE Management</a>
                <br>
                Login: $request->email
                <br>
                Password: $request->password
            </div>
        ";

        Mail::to($request->email)->send(new CredentialsMail($credentials));
        return redirect()->back()->with('success', 'Client added and credentials sended.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $client)
    {
        if(!auth()->user()->isAdmin() && $client->id !== auth()->id()) abort('404');
        return view('dashboard.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $client)
    {
        return view('dashboard.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $client)
    {
        $request->validate([
            'name' => 'required',
            'subdomain' => [
                'required',
                Rule::unique('users')->ignore($client->id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($client->id),
            ],
            'avatar' => 'image',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'subdomain' => $request->subdomain,
            'bg_color' => $request->bg_color,
            'text_color' => $request->text_color,
            'welcome_text' => $request->welcome_text,
        ];

        if($request->_remove_avatar == 'remove_avatar') {
            Storage::delete($client->avatar);
            $data['avatar'] = NULL;
        } elseif($request->hasFile('avatar')) {
            Storage::delete($client->avatar);
            $folder = date('Y-m');
            $data['avatar'] = $request->file('avatar')->store("{$folder}");
        }

        $client->update($data);
        User::where('company', $client->id)->update(['avatar' => $client->avatar]);
        $loginUrl = getProtocol() . getDomain() . '/login';

        $credentials = "
            Your account on WE Management have updated.
            <hr>
            <div>
                URL: <a href='$loginUrl'>WE Management</a>
                <br>
                Login: $request->email
                <br>
                Password: <i>Your password</i>
            </div>
        ";

        Mail::to($request->email)->send(new CredentialsMail($credentials));
        return redirect()->route('clients.index')->with('success', 'Client info updated and credentials sended.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $client)
    {
        $client->delete();
        $client->forms()->detach();
        $client->pages()->detach();
        Order::where('user_id', $client->id)->delete();
        Data::where('user_id', $client->id)->delete();
        $url =  url('') . '/dashboard/clients';
        return response()->json(['status' => 'deleted', 'url' => $url]);
    }
}
