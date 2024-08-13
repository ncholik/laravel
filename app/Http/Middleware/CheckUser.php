<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Kepegawaian\Entities\Pegawai;
use Modules\Kepegawaian\Entities\Pejabat;
use Modules\KeuanganMPA\Entities\Unit;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            // Jika user adalah admin, tidak perlu mengatur unit di session
            return $next($request);
        }
        $pegawai = Pegawai::with('user')->where('unit_id', $user->id)->first();

        $pejabat = null;
        if ($pegawai) {
            $pejabat = Pejabat::with('pegawai')->where('pegawai_id', $pegawai->id)->first();
        }

        if ($pejabat) {
            $unit_id = $pejabat->unit_id;

            $unit = Unit::find($unit_id);

            if ($unit) {
                session(['units' => $unit]);
            }
        } else {
            return redirect()->route('dashboard')->with('error', 'Pejabat tidak ditemukan');
        }

        // dd($unit);
        return $next($request);
    }
}
