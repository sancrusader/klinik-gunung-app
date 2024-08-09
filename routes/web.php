<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\screening\QueueController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\screening\ScreeningController;
use App\Http\Controllers\clinic_core\PaymentController;
use App\Http\Controllers\clinic_core\AppointmentController;
use App\Http\Controllers\clinic_core\ConsultationController;
use App\Http\Controllers\clinic_core\MedicalRecordController;
use App\Http\Controllers\screening\ScreeningOfflineController;
use App\Http\Controllers\dashboard\PasienController;
use App\Http\Controllers\dashboard\ParamedisController;
use App\Http\Controllers\dashboard\ManajerController;
use App\Http\Controllers\dashboard\KasirController;
use App\Http\Controllers\dashboard\AdminController;
use App\Http\Controllers\dashboard\DokterController;
use App\Http\Controllers\dashboard\KoordinatorPenyelamatController;


// Home Page
Route::get('/', function () {
    return view('welcome');
})->name('/');

// About Page
Route::get('about', function () {
    return view('pages.about', ['title' => 'About Us']);
})->name('about');

// Blog Page
Route::get('blog', function () {
    return view('pages.blog', ['title' => 'Blog']);
})->name('blog');

// Services Page
Route::get('services', function () {
    return view('pages.services', ['title' => 'Services']);
})->name('services');


// Contact Page
Route::get('contact', function () {
    return view('pages.contact', ['title' => 'Contact']);
})->name('contact');


// Products Page
Route::get('products', function () {
    return view('pages.products', ['title' => 'Products']);
})->name('products');

// !End Page


// Auth 

Route::get('/login', function () {
    return view('auth.login', ['title' => 'Login']);
})->middleware('guest')->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', function () {
    return view('auth.register', ['title' => 'Register']);
})->middleware('guest')->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// !End Auth



// Verification Email

Route::get('email/verify/{id}/{hash}', [AuthController::class, 'verify'])
    ->name('verification.verify')
    ->middleware(['signed', 'throttle:6,1']);
Route::post('email/resend', [AuthController::class, 'resend'])->name('verification.resend');
Route::get('verify-email', function () {
    return view('auth.verify-email');
})->name('verify.email');

// !End Verification Email 


// Dashboard

Route::middleware(['auth'])->group(function () {

    // Role Admin
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.welcome');

        Route::get('/admin/scan', function () {
            return view('admin.scan');
        })->name('admin.scan');
        Route::post('/admin/scan/process', [AdminController::class, 'scanQr'])->name('admin.scan.process');

        // Table Users
        Route::post('/admin/store-user', [AdminController::class, 'storeUser'])->name('admin.storeUser');
        Route::get('/admin/users', [AdminController::class, 'createUser'])->name('admin.createUser');
        Route::get('/admin/pasien', [UserController::class, 'showPasien'])->name('showPasien');
        Route::get('/admin/admin', [UserController::class, 'showAdmin'])->name('showAdmin');
        Route::get('/admin/kasir', [UserController::class, 'showKasir'])->name('showKasir');
        Route::get('/admin/perawat', [UserController::class, 'showParamedis'])->name('showParamedis');
        Route::get('/admin/dokter', [UserController::class, 'showDokter'])->name('showDokter');
        Route::get('/admin/manajer', [UserController::class, 'showManajer'])->name('showManajer');
        Route::get('/admin/koordinator-penyelamat', [UserController::class, 'showkoordinatorPenyelamat'])->name('showKoordinatorPenyelamat');

        // Shift
        Route::post('/admin/shift', [AdminController::class, 'shiftAdmin'])->name('shift.admin');
    });

    // Role Pendaki
    Route::middleware(['auth', 'role:pasien'])->group(function () {
        Route::get('/pasien/dashboard', [PasienController::class, 'index'])->name('pasien.welcome');
        Route::get('/pasien/consultasi', [ConsultationController::class, 'hikerIndex'])->name('pasien.consultasi.index');
        Route::post('/pasien/consultasi', [ConsultationController::class, 'store'])->name('pasien.consultasi.store');

        Route::get('pasien/screenings', [ScreeningController::class, 'index'])->name('screenings.index');
        Route::get('pasien/screenings/create', [ScreeningController::class, 'create'])->name('screenings.create');
        Route::post('pasien/screenings', [ScreeningController::class, 'store'])->name('screenings.store');
        Route::get('pasien/screenings/payment/{id}', [ScreeningController::class, 'payment'])->name('screenings.payment');
        Route::post('pasien/screenings/payment-callback', [ScreeningController::class, 'paymentCallback'])->name('screenings.payment.callback');


        // Membuat Screening Offline
        Route::get('/screening-offline/create', [ScreeningOfflineController::class, 'create'])->name('screening-offline.create');
        Route::post('/screening-offline', [ScreeningOfflineController::class, 'store'])->name('screening-offline.store');
        // Rute untuk menampilkan jadwal yang belum memiliki konsultasi
        Route::get('pasien/consultasi-schedule', [ConsultationController::class, 'createSchedule'])->name('pasien.create_schedule');

        Route::get('pasien/appointments', [AppointmentController::class, 'index'])->name('pasien.appointments.index');
        Route::get('pasien/appointments/create', [AppointmentController::class, 'create'])->name('pasien.appointments.create');
        Route::post('pasien/appointments', [AppointmentController::class, 'store'])->name('pasien.appointments.store');
        Route::get('pasien/appointments/{appointment}', [AppointmentController::class, 'show'])->name('pasien.appointments.show');
        Route::get('pasien/appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('pasien.appointments.edit');
        Route::put('pasien/appointments/{appointment}', [AppointmentController::class, 'update'])->name('pasien.appointments.update');
        Route::delete('pasien/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('pasien.appointments.destroy');
    });

    //  Role Dokter
    Route::middleware(['role:dokter'])->group(function () {
        Route::get('/dokter/dashboard', [DokterController::class, 'dashboard'])->name('dokter.welcome');
        Route::get('/dokter/consultasi', [ConsultationController::class, 'doctorIndex'])->name('dokter.consultasi.index');
        Route::post('/dokter/consultasi/{consultation}/complete', [ConsultationController::class, 'complete'])->name('dokter.consultasi.complete');

        Route::get('dokter/shif', [DokterController::class, 'shif'])->name('dokter.shif');
        // Rute untuk menampilkan jadwal konsultasi dokter
        Route::get('dokter/jadwal', [ConsultationController::class, 'doctorSchedule'])->name('dokter.schedule');
        // Rute untuk menyelesaikan konsultasi
        Route::patch('dokter/consultations/{consultation}/complete', [ConsultationController::class, 'ScheduleComplete'])->name('dokter.complete');
        Route::get('dokter/appointments', [AppointmentController::class, 'doctorIndex'])->name('dokter.appointments.index');
        Route::get('dokter/appointments/{appointment}', [AppointmentController::class, 'doctorShow'])->name('dokter.appointments.show');
        Route::put('dokter/appointments/{appointment}/confirm', [AppointmentController::class, 'accept'])->name('dokter.appointments.confirm');
        Route::put('dokter/appointments/{appointment}/complete', [AppointmentController::class, 'complete'])->name('dokter.appointments.complete');
        // Rute untuk rekam medis
        Route::get('dokter/appointments/{appointment}/edit', [MedicalRecordController::class, 'edit'])->name('dokter.medical_records.edit');
        Route::put('dokter/appointments/{appointment}/update', [MedicalRecordController::class, 'update'])->name('dokter.medical_records.update');
    });
    // Role Paramedis
    Route::middleware(['role:paramedis'])->group(function () {
        Route::get('/paramedis/dashboard', [ParamedisController::class, 'index'])->name('paramedis.welcome');
        Route::get('/paramedis/screening', [ParamedisController::class, 'dashboard'])->name('paramedis.dashboard');
        Route::get('/paramedis/data', [ParamedisController::class, 'dashboard'])->name('paramedis.data');
        Route::post('/paramedis/health-check/{id}', [ParamedisController::class, 'processHealthCheck'])->name('paramedis.processHealthCheck');
        // screening Offline
        Route::get('/paramedis/screening-offline', [ParamedisController::class, 'ScreeningOffline'])->name('paramedis.ScreeningOffline');
        Route::post('/paramedis/confirm/{id}', [ParamedisController::class, 'updateHealthCheck'])->name('paramedis.confirm');
    });


    // Route::middleware(['role:receptionst'])->group(function () {
    //     Route::get('/receptionst/dashboard', [KoordinatorController::class, 'index'])->name('receptionst.welcome');

    // });

    // Role Koordinator
    Route::middleware(['role:koordinator'])->group(function () {
        Route::get('/koordinator/dashboard', [KoordinatorPenyelamatController::class, 'index'])->name('koordinator.welcome');
        Route::get('koordinator/manajemen-darurat', [KoordinatorPenyelamatController::class, 'ManajemenDarurat'])->name('koordinator.manajemen');
        Route::get('koordinator/report', [KoordinatorPenyelamatController::class, 'report'])->name('koordinator.report');
    });

    // Role Manajer
    Route::middleware(['auth', 'role:manajer'])->group(function () {
        Route::get('/manajer/dashboard', [ManajerController::class, 'index'])->name('manajer.welcome');
        Route::get('/manajer/schedule', [ManajerController::class, 'showScheduleForm'])->name('manajer.schedule.form');
        Route::post('/manajer/schedule', [ManajerController::class, 'storeSchedule'])->name('manajer.schedule.store');

        // Menghasilkan laporan
        Route::get('/manajer/reports', [ManajerController::class, 'viewReports'])->name('manajer.reports');
        Route::post('/manajer/report', [ManajerController::class, 'generateReport'])->name('manajer.report.generate');
    });

    // Role Kasir
    Route::middleware(['role:kasir'])->group(function () {
        // Dashboard Kasir
        Route::get('/kasir/dashboard', [KasirController::class, 'index'])->name('kasir.welcome');
        // Confirm Payment
        Route::post('/kasir/confirm-payment/{id}', [KasirController::class, 'confirmPayment'])->name('kasir.confirmPayment');
        Route::get('/kasir/certificate/{id}', [KasirController::class, 'showCertificate'])->name('kasir.showCertificate');
        Route::get('/kasir/certificates', [KasirController::class, 'viewCertificates'])->name('kasir.certificates');
        // Screening Offline
        Route::get('/kasir/screening-offline', [KasirController::class, 'ScreeningOffline'])->name('kasir.screening');
        Route::post('/kasir/confirm/{id}', [KasirController::class, 'confirmPaymentOffline'])->name('kasir.confirm');
        // Sift Kasir
        Route::get('kasir/shif', [KasirController::class, 'shifKasir'])->name('kasir.shif');
        // History Pembayaran
        Route::get('/kasir/payment-history', [KasirController::class, 'paymentHistory'])->name('kasir.paymentHistory');
    });

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('profile/update-photo', [ProfileController::class, 'updatePhoto'])->name('profile.update.photo');
    Route::get('/profile/password', [ProfileController::class, 'showPasswordForm'])->name('profile.showPasswordForm');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');

    Route::middleware(['auth'])->group(function () {
        Route::get('/screenings/create', [ScreeningController::class, 'create'])->name('screenings.create');
        Route::post('/screenings', [ScreeningController::class, 'store'])->name('screenings.store');
        Route::get('/screenings', [ScreeningController::class, 'index'])->name('screenings.index');
        Route::get('queues', [QueueController::class, 'index'])->name('queues.index');
        Route::get('queues/confirm-payment/{id}', [QueueController::class, 'confirmPayment'])->name('queues.confirmPayment');
        Route::get('screening-offline/{queue}', [ScreeningOfflineController::class, 'create'])->name('screenings.offline.create');
        Route::post('screenings/offline/{queue}', [ScreeningOfflineController::class, 'store'])->name('screenings.offline.store');
        Route::get('payments/create/{queue}', [PaymentController::class, 'create'])->name('payments.create');
        Route::post('payments/store/{queue}', [PaymentController::class, 'store'])->name('payments.store');
    });
});

// Ongoing Membuat posts untuk blog
Route::resource('posts', PostController::class);
