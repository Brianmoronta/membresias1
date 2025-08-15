<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class VisitaController extends Controller
{
    public function registrarPorNumero($membership_number)
    {
        $member = Member::where('membership_number', $membership_number)->first();
    
        if (!$member) {
            return "Socio no encontrado.";
        }
    
        $member->total_visitas += 1;
        $member->save();
    
        return view('visita.confirmacion', ['member' => $member]);
    }
    
}
