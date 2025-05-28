<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Companies::all();
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:companies,name|max:255',
            'email' => 'nullable|email|unique:companies,email',
            'website' => 'nullable|url|unique:companies,website',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.unique' => 'Name must be unique.',
            'name.required' => 'Company name is required.',
            'email.email' => 'Email must be a valid email address.',
            'email.unique' => 'Email must be unique.',
            'website.url' => 'Website must be a valid URL.',
            'website.unique' => 'Website must be unique.',
            'logo.image' => 'Logo must be an image file.',
            'logo.mimes' => 'Logo must be a jpeg, png, jpg, or gif file.',
            'logo.max' => 'Logo may not be greater than 2MB.',
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');

            [$width, $height] = getimagesize($file);
            if ($width < 100 || $height < 100) {
                return back()->withErrors(['logo' => 'Logo must be at least 100x100 pixels.'])->withInput();
            }

            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('logos', $filename, 'public');

            $validated['logo'] = $filename;
        }

        Companies::create($validated);

        return redirect()->route('companies.index')->with('success', 'Company created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = Companies::findOrFail($id);
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $company = Companies::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:companies,name,' . $company->id,
            'email' => 'nullable|email|unique:companies,email,' . $company->id,
            'website' => 'nullable|url|unique:companies,website,' . $company->id,
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.unique' => 'Name must be unique.',
            'name.required' => 'Company name is required.',
            'email.email' => 'Email must be a valid email address.',
            'email.unique' => 'Email must be unique.',
            'website.url' => 'Website must be a valid URL.',
            'website.unique' => 'Website must be unique.',
            'logo.image' => 'Logo must be an image file.',
            'logo.mimes' => 'Logo must be a jpeg, png, jpg, or gif file.',
            'logo.max' => 'Logo may not be greater than 2MB.',
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');

            [$width, $height] = getimagesize($file);
            if ($width < 100 || $height < 100) {
                return back()->withErrors(['logo' => 'Logo must be at least 100x100 pixels.'])->withInput();
            }

            if ($company->logo && Storage::exists($company->logo)) {
                Storage::delete($company->logo);
            }

            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs($filename);

            $validated['logo'] = $filename;
        }

        $company->update($validated);

        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Companies::findOrFail($id);
        
        if ($company->logo) {
            $logoPath = storage_path('app/public/' . $company->logo);
            if (file_exists($logoPath)) {
                unlink($logoPath);
            }
        }

        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}
