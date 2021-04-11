<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPackageRequest;
use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use App\Models\Package;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PackageController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('package_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $packages = Package::with(['author'])->get();

        $users = User::get();

        return view('admin.packages.index', compact('packages', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('package_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $authors = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.packages.create', compact('authors'));
    }

    public function store(StorePackageRequest $request)
    {
        $package = Package::create($request->all());

        return redirect()->route('admin.packages.index');
    }

    public function edit(Package $package)
    {
        abort_if(Gate::denies('package_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $authors = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $package->load('author');

        return view('admin.packages.edit', compact('authors', 'package'));
    }

    public function update(UpdatePackageRequest $request, Package $package)
    {
        $package->update($request->all());

        return redirect()->route('admin.packages.index');
    }

    public function show(Package $package)
    {
        abort_if(Gate::denies('package_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $package->load('author');

        return view('admin.packages.show', compact('package'));
    }

    public function destroy(Package $package)
    {
        abort_if(Gate::denies('package_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $package->delete();

        return back();
    }

    public function massDestroy(MassDestroyPackageRequest $request)
    {
        Package::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
