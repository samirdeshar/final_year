@extends('layouts.backend_layout.template')
@push('styles')
    <style>
        .this-one {
            color: #555;
            font-size: 14px;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            margin: 10px 0;
        }

        .this-one hr {
            margin: 50px 0;
        }

        .this-one ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        ul.padding {
            padding-left: 25px;
        }

        .this-one .container {
            margin: 40px auto;
            max-width: 700px;
        }

        .this-one li {
            margin-top: 1em;
        }

        .this-one label {
            font-weight: bold;
        }

    </style>
@endpush
@section('main-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <h1>Create New Role <a href="{{ route('roles.index') }}" class="btn btn-sm btn-primary">View Roles</a>
                </h1>
                <form action="{{ route('roles.update', $role->id) }}" method="POST" class="bg-light p-3">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Role Name: </label>
                                <input type="text" name="name" class="form-control" value="{{ $role->name }}"
                                    placeholder="Enter Permission Name">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="this-one col-md-4">
                            <ul>
                                <li>
                                    <input type="checkbox" /> Manage User
                                    <ul class="padding">
                                        @php
                                            $userperms = DB::table('permissions')
                                                ->where('column_name', 'user')
                                                ->get();
                                        @endphp
                                        @foreach ($userperms as $userperm)
                                            <li>
                                                <input type="checkbox" name="permissions[]" value="{{ $userperm->id }}"
                                                @if(in_array($userperm->id, $selectedperm))
                                                    {{"checked"}}
                                                @else
                                                    {{""}}
                                                @endif
                                                >{{ $userperm->name }}
                                            </li>
                                        @endforeach

                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="this-one col-md-4">
                            <ul>
                                <li>
                                    <input type="checkbox" /> Manage Role
                                    <ul class="padding">
                                        @php
                                            $userperms = DB::table('permissions')
                                                ->where('column_name', 'role')
                                                ->get();
                                        @endphp
                                        @foreach ($userperms as $userperm)
                                            <li>
                                                <input type="checkbox" name="permissions[]" value="{{ $userperm->id }}"
                                                @if(in_array($userperm->id, $selectedperm))
                                                    {{"checked"}}
                                                @else
                                                    {{""}}
                                                @endif
                                                >{{ $userperm->name }}
                                            </li>
                                        @endforeach

                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="this-one col-md-4">
                            <ul>
                                <li>
                                    <input type="checkbox" /> Manage Permission
                                    <ul class="padding">
                                        @php
                                            $userperms = DB::table('permissions')
                                                ->where('column_name', 'permission')
                                                ->get();
                                        @endphp
                                        @foreach ($userperms as $userperm)
                                            <li>
                                                <input type="checkbox" name="permissions[]" value="{{ $userperm->id }}"
                                                @if(in_array($userperm->id, $selectedperm))
                                                    {{"checked"}}
                                                @else
                                                    {{""}}
                                                @endif
                                                >{{ $userperm->name }}
                                            </li>
                                        @endforeach

                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <div class="this-one col-md-4">
                            <ul>
                                <li>
                                    <input type="checkbox" /> Manage Banner
                                    <ul class="padding">
                                        @php
                                            $userperms = DB::table('permissions')
                                                ->where('column_name', 'Banner')
                                                ->get();
                                        @endphp
                                        @foreach ($userperms as $userperm)
                                            <li>
                                                <input type="checkbox" name="permissions[]" value="{{ $userperm->id }}"
                                                @if(in_array($userperm->id, $selectedperm))
                                                    {{"checked"}}
                                                @else
                                                    {{""}}
                                                @endif
                                                >{{ $userperm->name }}
                                            </li>
                                        @endforeach

                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <div class="this-one col-md-4">
                            <ul>
                                <li>
                                    <input type="checkbox" /> Manage Post
                                    <ul class="padding">
                                        @php
                                            $userperms = DB::table('permissions')
                                                ->where('column_name', 'Post')
                                                ->get();
                                        @endphp
                                        @foreach ($userperms as $userperm)
                                            <li>
                                                <input type="checkbox" name="permissions[]" value="{{ $userperm->id }}"
                                                @if(in_array($userperm->id, $selectedperm))
                                                    {{"checked"}}
                                                @else
                                                    {{""}}
                                                @endif
                                                >{{ $userperm->name }}
                                            </li>
                                        @endforeach

                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <div class="this-one col-md-4">
                            <ul>
                                <li>
                                    <input type="checkbox" /> Manage Postcategory
                                    <ul class="padding">
                                        @php
                                            $userperms = DB::table('permissions')
                                                ->where('column_name', 'Postcategory')
                                                ->get();
                                        @endphp
                                        @foreach ($userperms as $userperm)
                                            <li>
                                                <input type="checkbox" name="permissions[]" value="{{ $userperm->id }}"
                                                @if(in_array($userperm->id, $selectedperm))
                                                    {{"checked"}}
                                                @else
                                                    {{""}}
                                                @endif
                                                >{{ $userperm->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <div class="this-one col-md-4">
                            <ul>
                                <li>
                                    <input type="checkbox" /> Manage Posttag
                                    <ul class="padding">
                                        @php
                                            $userperms = DB::table('permissions')
                                                ->where('column_name', 'Posttag')
                                                ->get();
                                        @endphp
                                        @foreach ($userperms as $userperm)
                                            <li>
                                                <input type="checkbox" name="permissions[]" value="{{ $userperm->id }}"
                                                @if(in_array($userperm->id, $selectedperm))
                                                    {{"checked"}}
                                                @else
                                                    {{""}}
                                                @endif
                                                >{{ $userperm->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <div class="this-one col-md-4">
                            <ul>
                                <li>
                                    <input type="checkbox" /> Manage Setting
                                    <ul class="padding">
                                        @php
                                            $userperms = DB::table('permissions')
                                                ->where('column_name', 'Setting')
                                                ->get();
                                        @endphp
                                        @foreach ($userperms as $userperm)
                                            <li>
                                                <input type="checkbox" name="permissions[]" value="{{ $userperm->id }}"
                                                @if(in_array($userperm->id, $selectedperm))
                                                    {{"checked"}}
                                                @else
                                                    {{""}}
                                                @endif
                                                >{{ $userperm->name }}
                                            </li>
                                        @endforeach

                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <div class="this-one col-md-4">
                            <ul>
                                <li>
                                    <input type="checkbox" /> Manage Pages
                                    <ul class="padding">
                                        @php
                                            $userperms = DB::table('permissions')
                                                ->where('column_name', 'Generalpage')
                                                ->get();
                                        @endphp
                                        @foreach ($userperms as $userperm)
                                            <li>
                                                <input type="checkbox" name="permissions[]" value="{{ $userperm->id }}"
                                                @if(in_array($userperm->id, $selectedperm))
                                                    {{"checked"}}
                                                @else
                                                    {{""}}
                                                @endif
                                                >{{ $userperm->name }}
                                            </li>
                                        @endforeach

                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <div class="this-one col-md-4">
                            <ul>
                                <li>
                                    <input type="checkbox" /> Manage Testimonial
                                    <ul class="padding">
                                        @php
                                            $userperms = DB::table('permissions')
                                                ->where('column_name', 'Testimonial')
                                                ->get();
                                        @endphp
                                        @foreach ($userperms as $userperm)
                                            <li>
                                                <input type="checkbox" name="permissions[]" value="{{ $userperm->id }}"
                                                @if(in_array($userperm->id, $selectedperm))
                                                    {{"checked"}}
                                                @else
                                                    {{""}}
                                                @endif
                                                >{{ $userperm->name }}
                                            </li>
                                        @endforeach

                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <div class="this-one col-md-4">
                            <ul>
                                <li>
                                    <input type="checkbox" /> Manage About
                                    <ul class="padding">
                                        @php
                                            $userperms = DB::table('permissions')
                                                ->where('column_name', 'About')
                                                ->get();
                                        @endphp
                                        @foreach ($userperms as $userperm)
                                            <li>
                                                <input type="checkbox" name="permissions[]" value="{{ $userperm->id }}"
                                                @if(in_array($userperm->id, $selectedperm))
                                                    {{"checked"}}
                                                @else
                                                    {{""}}
                                                @endif
                                                >{{ $userperm->name }}
                                            </li>
                                        @endforeach

                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <div class="this-one col-md-4">
                            <ul>
                                <li>
                                    <input type="checkbox" /> Manage Partner
                                    <ul class="padding">
                                        @php
                                            $userperms = DB::table('permissions')
                                                ->where('column_name', 'Partner')
                                                ->get();
                                        @endphp
                                        @foreach ($userperms as $userperm)
                                            <li>
                                                <input type="checkbox" name="permissions[]" value="{{ $userperm->id }}"
                                                @if(in_array($userperm->id, $selectedperm))
                                                    {{"checked"}}
                                                @else
                                                    {{""}}
                                                @endif
                                                >{{ $userperm->name }}
                                            </li>
                                        @endforeach

                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <div class="this-one col-md-4">
                            <ul>
                                <li>
                                    <input type="checkbox" /> Manage Generalfaq
                                    <ul class="padding">
                                        @php
                                            $userperms = DB::table('permissions')
                                                ->where('column_name', 'Generalfaq')
                                                ->get();
                                        @endphp
                                        @foreach ($userperms as $userperm)
                                            <li>
                                                <input type="checkbox" name="permissions[]" value="{{ $userperm->id }}"
                                                @if(in_array($userperm->id, $selectedperm))
                                                    {{"checked"}}
                                                @else
                                                    {{""}}
                                                @endif
                                                >{{ $userperm->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <div class="this-one col-md-4">
                            <ul>
                                <li>
                                    <input type="checkbox" /> Manage Teammember
                                    <ul class="padding">
                                        @php
                                            $userperms = DB::table('permissions')
                                                ->where('column_name', 'Teammember')
                                                ->get();
                                        @endphp
                                        @foreach ($userperms as $userperm)
                                            <li>
                                                <input type="checkbox" name="permissions[]" value="{{ $userperm->id }}"
                                                @if(in_array($userperm->id, $selectedperm))
                                                    {{"checked"}}
                                                @else
                                                    {{""}}
                                                @endif
                                                >{{ $userperm->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <div class="this-one col-md-4">
                            <ul>
                                <li>
                                    <input type="checkbox" /> Manage Teamcategory
                                    <ul class="padding">
                                        @php
                                            $userperms = DB::table('permissions')
                                                ->where('column_name', 'Teamcategory')
                                                ->get();
                                        @endphp
                                        @foreach ($userperms as $userperm)
                                            <li>
                                                <input type="checkbox" name="permissions[]" value="{{ $userperm->id }}"
                                                @if(in_array($userperm->id, $selectedperm))
                                                    {{"checked"}}
                                                @else
                                                    {{""}}
                                                @endif
                                                >{{ $userperm->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>


                        <div class="this-one col-md-4">
                            <ul>
                                <li>
                                    <input type="checkbox" /> Manage Trip
                                    <ul class="padding">
                                        @php
                                            $userperms = DB::table('permissions')
                                                ->where('column_name', 'Trip')
                                                ->get();
                                        @endphp
                                        @foreach ($userperms as $userperm)
                                            <li>
                                                <input type="checkbox" name="permissions[]" value="{{ $userperm->id }}"
                                                @if(in_array($userperm->id, $selectedperm))
                                                    {{"checked"}}
                                                @else
                                                    {{""}}
                                                @endif
                                                >{{ $userperm->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <div class="this-one col-md-4">
                            <ul>
                                <li>
                                    <input type="checkbox" /> Manage Tripcategory
                                    <ul class="padding">
                                        @php
                                            $userperms = DB::table('permissions')
                                                ->where('column_name', 'Tripcategory')
                                                ->get();
                                        @endphp
                                        @foreach ($userperms as $userperm)
                                            <li>
                                                <input type="checkbox" name="permissions[]" value="{{ $userperm->id }}"
                                                @if(in_array($userperm->id, $selectedperm))
                                                    {{"checked"}}
                                                @else
                                                    {{""}}
                                                @endif
                                                >{{ $userperm->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <div class="this-one col-md-4">
                            <ul>
                                <li>
                                    <input type="checkbox" /> Manage Triptag
                                    <ul class="padding">
                                        @php
                                            $userperms = DB::table('permissions')
                                                ->where('column_name', 'Triptag')
                                                ->get();
                                        @endphp
                                        @foreach ($userperms as $userperm)
                                            <li>
                                                <input type="checkbox" name="permissions[]" value="{{ $userperm->id }}"
                                                @if(in_array($userperm->id, $selectedperm))
                                                    {{"checked"}}
                                                @else
                                                    {{""}}
                                                @endif
                                                >{{ $userperm->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <div class="this-one col-md-4">
                            <ul>
                                <li>
                                    <input type="checkbox" /> Manage Travel Info
                                    <ul class="padding">
                                        @php
                                            $userperms = DB::table('permissions')
                                                ->where('column_name', 'Travelinfo')
                                                ->get();
                                        @endphp
                                        @foreach ($userperms as $userperm)
                                            <li>
                                                <input type="checkbox" name="permissions[]" value="{{ $userperm->id }}"
                                                @if(in_array($userperm->id, $selectedperm))
                                                    {{"checked"}}
                                                @else
                                                    {{""}}
                                                @endif
                                                >{{ $userperm->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>


                        <div class="this-one col-md-4">
                            <ul>
                                <li>
                                    <input type="checkbox" /> Manage Travel Category
                                    <ul class="padding">
                                        @php
                                            $userperms = DB::table('permissions')
                                                ->where('column_name', 'Travelcategory')
                                                ->get();
                                        @endphp
                                        @foreach ($userperms as $userperm)
                                            <li>
                                                <input type="checkbox" name="permissions[]" value="{{ $userperm->id }}"
                                                @if(in_array($userperm->id, $selectedperm))
                                                    {{"checked"}}
                                                @else
                                                    {{""}}
                                                @endif
                                                >{{ $userperm->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <div class="this-one col-md-4">
                            <ul>
                                <li>
                                    <input type="checkbox" /> Manage Travel Trip Type
                                    <ul class="padding">
                                        @php
                                            $userperms = DB::table('permissions')
                                                ->where('column_name', 'Traveltriptype')
                                                ->get();
                                        @endphp
                                        @foreach ($userperms as $userperm)
                                            <li>
                                                <input type="checkbox" name="permissions[]" value="{{ $userperm->id }}"
                                                @if(in_array($userperm->id, $selectedperm))
                                                    {{"checked"}}
                                                @else
                                                    {{""}}
                                                @endif
                                                >{{ $userperm->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <div class="this-one col-md-4">
                            <ul>
                                <li>
                                    <input type="checkbox" /> Manage Travel Trip Type
                                    <ul class="padding">
                                        @php
                                            $userperms = DB::table('permissions')
                                                ->where('column_name', 'Traveltriptype')
                                                ->get();
                                        @endphp
                                        @foreach ($userperms as $userperm)
                                            <li>
                                                <input type="checkbox" name="permissions[]" value="{{ $userperm->id }}"
                                                @if(in_array($userperm->id, $selectedperm))
                                                    {{"checked"}}
                                                @else
                                                    {{""}}
                                                @endif
                                                >{{ $userperm->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <div class="this-one col-md-4">
                            <ul>
                                <li>
                                    <input type="checkbox" /> Manage Cybercast
                                    <ul class="padding">
                                        @php
                                            $userperms = DB::table('permissions')
                                                ->where('column_name', 'Cybercast')
                                                ->get();
                                        @endphp
                                        @foreach ($userperms as $userperm)
                                            <li>
                                                <input type="checkbox" name="permissions[]" value="{{ $userperm->id }}"
                                                @if(in_array($userperm->id, $selectedperm))
                                                    {{"checked"}}
                                                @else
                                                    {{""}}
                                                @endif
                                                >{{ $userperm->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <div class="this-one col-md-4">
                            <ul>
                                <li>
                                    <input type="checkbox" /> Manage Cybercast Post
                                    <ul class="padding">
                                        @php
                                            $userperms = DB::table('permissions')
                                                ->where('column_name', 'Cybercastpost')
                                                ->get();
                                        @endphp
                                        @foreach ($userperms as $userperm)
                                            <li>
                                                <input type="checkbox" name="permissions[]" value="{{ $userperm->id }}"
                                                @if(in_array($userperm->id, $selectedperm))
                                                    {{"checked"}}
                                                @else
                                                    {{""}}
                                                @endif
                                                >{{ $userperm->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>


                        <div class="this-one col-md-4">
                            <ul>
                                <li>
                                    <input type="checkbox" /> Manage Cyber Category
                                    <ul class="padding">
                                        @php
                                            $userperms = DB::table('permissions')
                                                ->where('column_name', 'Cybercategory')
                                                ->get();
                                        @endphp
                                        @foreach ($userperms as $userperm)
                                            <li>
                                                <input type="checkbox" name="permissions[]" value="{{ $userperm->id }}"
                                                @if(in_array($userperm->id, $selectedperm))
                                                    {{"checked"}}
                                                @else
                                                    {{""}}
                                                @endif
                                                >{{ $userperm->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <div class="this-one col-md-4">
                            <ul>
                                <li>
                                    <input type="checkbox" /> Manage Community Support
                                    <ul class="padding">
                                        @php
                                            $userperms = DB::table('permissions')
                                                ->where('column_name', 'Hike')
                                                ->get();
                                        @endphp
                                        @foreach ($userperms as $userperm)
                                            <li>
                                                <input type="checkbox" name="permissions[]" value="{{ $userperm->id }}"
                                                @if(in_array($userperm->id, $selectedperm))
                                                    {{"checked"}}
                                                @else
                                                    {{""}}
                                                @endif
                                                >{{ $userperm->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>


                        <div class="this-one col-md-4">
                            <ul>
                                <li>
                                    <input type="checkbox" /> Manage Dashboard
                                    <ul class="padding">
                                        @php
                                            $userperms = DB::table('permissions')
                                                ->where('column_name', 'Dashboard')
                                                ->get();
                                        @endphp
                                        @foreach ($userperms as $userperm)
                                            <li>
                                                <input type="checkbox" name="permissions[]" value="{{ $userperm->id }}"
                                                @if(in_array($userperm->id, $selectedperm))
                                                    {{"checked"}}
                                                @else
                                                    {{""}}
                                                @endif
                                                >{{ $userperm->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>


                        <div class="this-one col-md-4">
                            <ul>
                                <li>
                                    <input type="checkbox" /> Manage Information
                                    <ul class="padding">
                                        @php
                                            $userperms = DB::table('permissions')
                                                ->where('column_name', 'Information')
                                                ->get();
                                        @endphp
                                        @foreach ($userperms as $userperm)
                                            <li>
                                                <input type="checkbox" name="permissions[]" value="{{ $userperm->id }}"
                                                @if(in_array($userperm->id, $selectedperm))
                                                    {{"checked"}}
                                                @else
                                                    {{""}}
                                                @endif
                                                >{{ $userperm->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>


                        <div class="this-one col-md-4">
                            <ul>
                                <li>
                                    <input type="checkbox" /> Manage Menu
                                    <ul class="padding">
                                        @php
                                            $userperms = DB::table('permissions')
                                                ->where('column_name', 'Menu')
                                                ->get();
                                        @endphp
                                        @foreach ($userperms as $userperm)
                                            <li>
                                                <input type="checkbox" name="permissions[]" value="{{ $userperm->id }}"
                                                @if(in_array($userperm->id, $selectedperm))
                                                    {{"checked"}}
                                                @else
                                                    {{""}}
                                                @endif
                                                >{{ $userperm->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@push('scripts')
    <script>
        $('li :checkbox').on('click', function() {
            var $chk = $(this),
                $li = $chk.closest('li'),
                $ul, $parent;
            if ($li.has('ul')) {
                $li.find(':checkbox').not(this).prop('checked', this.checked)
            }
            do {
                $ul = $li.parent();
                $parent = $ul.siblings(':checkbox');
                if ($chk.is(':checked')) {
                    $parent.prop('checked', $ul.has(':checkbox:not(:checked)').length == 0)
                } else {
                    $parent.prop('checked', false)
                }
                $chk = $parent;
                $li = $chk.closest('li');
            } while ($ul.is(':not(.someclass)'));
        });
    </script>
@endpush
