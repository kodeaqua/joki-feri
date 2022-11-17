<?php

use App\Models\User;
use App\Models\BreakRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Redirect to Home */

Route::get('/', function () {
    return redirect(route('home'));
});

Route::get('/testview', function () {
});

Auth::routes();

/* Fix CVE #1 */
Route::get('/register', function () {
    return abort(404);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/break/request', function () {
    $page_title = "Pengajuan Cuti";
    $page_description = "Gunakan cuti dengan sebaik mungkin.";
    return view('menu.break_request', compact('page_title', 'page_description'));
})->middleware('auth')->name('breakRequestView');

Route::post('/break/request/send', function (Request $request) {
    $user = User::findOrFail(Auth::user()->id);

    if ($request->reason != "Sakit") {
        if ($request->duration > $user->quota) {
            return redirect()->back()->with('success', 'Anda tidak memiliki kuota yang cukup');
        }

        if ($user->quota <= 0) {
            return redirect()->back()->with('success', 'Anda tidak memiliki kuota yang cukup');
        }
    }

    $request->validate([
        'reason' => ['required'],
        'description' => ['required', 'max:255'],
        'break_start' => ['required'],
        'duration' => ['required']
    ]);

    $breakrequest = BreakRequest::create([
        'user_id' => $user->id,
        'reason' => $request->reason,
        'description' => $request->description,
        'break_start' => $request->break_start,
        'duration' => $request->duration
    ]);

    if ($breakrequest) {
        return redirect()->back()->with('success', 'Berhasil mengajukan');
    } else {
        return redirect()->back()->withErrors($request);
    }
})->middleware('auth')->name('breakRequestSend');

Route::get('/master/users', function () {
    $page_title = "Atur pengguna";
    $page_description = "Semua pengguna atau pegawai";
    $users = User::paginate(5);
    return view('menu.users', compact('page_title', 'page_description', 'users'));
})->middleware('auth')->name('usersManagementView');

Route::get('/master/users/add', function () {
    $page_title = "Tambah pengguna";
    $page_description = "Lengkapi informasi mengenai pengguna atau pegawai";
    return view('menu.users.add', compact('page_title', 'page_description'));
})->middleware('auth')->name('usersManagementAddView');

Route::post('/master/users/store', function (Request $request) {
    $validator = $request->validate([
        'nip' => ['required', 'string', 'max:32'],
        'name' => ['required', 'string', 'max:60'],
        'email' => ['required', 'string', 'email', 'unique:users'],
        'password' => ['required', 'string', 'min:8'],
        'position' => ['required', 'string', 'max:32'],
        'address' => ['required', 'string', 'max:64'],
        'telp' => ['required', 'string', 'max:16']
    ]);

    $user = User::create([
        'nip' => $request->nip,
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'is_admin' => (bool)$request->is_admin,
        'position' => $request->position,
        'address' => $request->address,
        'telp' => $request->telp
    ]);

    if ($user) {
        return redirect()->back()->with('success', 'Berhasil menambahkan!');
    } else {
        return redirect()->back()->withErrors($validator)->withInput();
    }
})->middleware('auth')->name('usersManagementStore');

Route::get('/master/users/{id}', function ($id) {
    $page_title = "Ubah pengguna";
    $page_description = "Informasi mengenai pengguna atau pegawai";
    $user = User::findOrFail($id);
    return view('menu.users.edit', compact('page_title', 'page_description', 'user'));
})->middleware('auth')->name('usersManagementEditView');

Route::put('/master/users/{id}/update', function (Request $request, $id) {
    $user = User::findOrFail($id);
    $validator = [];

    if ($request->nip != $user->nip && $request->nip != "") {
        $validator = $request->validate([
            'nip' => ['string', 'max:32'],
        ]);
        $user->update([
            'nip' => $request->nip
        ]);
    }

    if ($request->name != $user->name && $request->name != "") {
        $validator = $request->validate([
            'name' => ['string', 'max:60'],
        ]);
        $user->update([
            'name' => $request->name
        ]);
    }

    if ($request->email != $user->email && $request->email != "") {
        $validator = $request->validate([
            'email' => ['string', 'email', 'unique:users'],
        ]);
        $user->update([
            'email' => $request->email
        ]);
    }

    if (!Hash::check($request->password, $user->password) && $request->password != "") {
        $validator = $request->validate([
            'password' => ['string', 'min:8'],
        ]);
        $user->update([
            'password' => Hash::make($request->password)
        ]);
    }

    if ($request->position != $user->position && $request->position != "") {
        $validator = $request->validate([
            'position' => ['string', 'max:32'],
        ]);
        $user->update([
            'position' => $request->position
        ]);
    }

    if ($request->address != $user->address && $request->address != "") {
        $validator = $request->validate([
            'address' => ['string', 'max:64'],
        ]);
        $user->update([
            'address' => $request->address
        ]);
    }

    if ($request->telp != $user->telp && $request->telp != "") {
        $validator = $request->validate([
            'telp' => ['string', 'max:16'],
        ]);
        $user->update([
            'telp' => $request->telp
        ]);
    }

    if ($request->is_admin != $user->is_admin) {
        $user->update([
            'is_admin' => (bool)$request->is_admin
        ]);
    }

    if ($user) {
        return redirect()->back()->with('success', 'Berhasil diubah!');
    } else {
        return redirect()->back()->withErrors($validator);
    }
})->middleware('auth')->name('usersManagementUpdate');


Route::delete('/master/users/delete/{id}', function ($id) {
    $user = User::findOrFail($id);
    $user->delete();
    if ($user) {
        return redirect()->back()->with('success', 'Pengguna berhasil dihapus');
    } else {
        return redirect()->back()->withErrors($user);
    }
})->middleware('auth')->name('usersManagementDelete');

Route::get('/master/breaks', function () {
    $page_title = "Atur pengajuan cuti";
    $page_description = "Semua pengajuan cuti";
    $breakrequests = BreakRequest::with('user')->paginate(5);
    return view('menu.breaks', compact('page_title', 'page_description', 'breakrequests'));
})->middleware('auth')->name('breaksManagementView');

Route::delete('/master/breaks/delete/{id}', function ($id) {
    $breakrequest = BreakRequest::findOrFail($id);
    $breakrequest->delete();
    if ($breakrequest) {
        return redirect()->back()->with('success', 'Permintaan berhasil dihapus');
    } else {
        return redirect()->back()->withErrors($breakrequest);
    }
})->middleware('auth')->name('breaksManagementDelete');

Route::get('/master/breaks/print/{id}', function ($id) {
    $breakrequest = BreakRequest::findOrFail($id);
    return view('layouts.letter', compact('breakrequest'));
})->middleware('auth')->name('breaksManagementPrint');

Route::get('/master/breaks/accept/{id}', function ($id) {
    $breakrequest = BreakRequest::findOrFail($id);
    $breakrequest->update([
        'status' => true
    ]);
    $user = User::findOrFail($breakrequest->user_id);

    if ($breakrequest->reason != "Sakit") {
        $user->update([
            'quota' => $user->quota - $breakrequest->duration
        ]);
    }

    if ($breakrequest) {
        return redirect()->back()->with('success', 'Berhasil menerima!');
    }
})->middleware('auth')->name('breaksManagementAccept');

Route::get('/master/users/quota/reset', function () {
    $users = User::get();
    foreach ($users as $key => $value) {
        $user = User::findOrFail($value->id);
        $user->update([
            'quota' => 12
        ]);
    }
    return redirect()->back();
})->middleware('auth')->name('resetQuota');
