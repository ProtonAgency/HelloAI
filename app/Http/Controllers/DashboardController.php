<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Analysis\TextAnalysis;
use App\ArtificalIntelligence;
use App\Rules\Host;

use phpseclib\Net\SFTP;
use phpseclib\Crypt\RSA;

class DashboardController extends Controller
{
    public function viewModels()
    {
    	return view('models.list');
    }

    public function createModel()
    {
    	return view('models.create');
    }

    public function handleCreateModel(Request $request)
    {
		$request->validate([
			'name' => 'required|string',
			'type' => 'required|string',
		]);

		$types = [
			'text_analysis',
		];

		if(!in_array($request->input('type'), $types))
		{
			return view('models.create')->withErrors(['type' => 'Invalid type']);
		}

		$ai = ArtificalIntelligence::create([
			'name' => $request->input('name'),
			'type' => $request->input('type'),
			'identifier' => str_random(32),
			'user_id' => $request->user()->id,
		]);

		return redirect()->route('models', ['popup' => 'Model with identifier ' . $ai->identifier . ' created!']);
    }

    public function viewModel(Request $request, string $identifier)
    {
    	$ai = ArtificalIntelligence::where('identifier', $identifier)->get()->first();
    	if($ai === null)
    	{
    		return redirect()->back();
    	}

    	return view('models.view')->with('model', $ai);
    }
}
