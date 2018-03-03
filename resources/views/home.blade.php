@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="pr-25">
                    @guest @else<a data-toggle="modal"
                                   class="open-create-contact pull-right"
                                   href="#CreateContact">
                        <i class="color-create-button fa fa-plus-circle fa-3x" aria-hidden="true"></i>
                    </a>@endguest
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                        <table id="contacts" class="table table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>name</th>
                                <th>surname</th>
                                <th>email</th>
                                <th>phone number</th>
                                <th>address</th>
                                <th>dob</th>
                                @guest @else<th></th>@endguest
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($contacts as $contact)
                                <tr class="single-row">
                                    <th>{{$contact->name}}</th>
                                    <th>{{$contact->surname}}</th>
                                    <th>{{$contact->email}}</th>
                                    <th>{{$contact->phone_number}}</th>
                                    <th>{{$contact->address}}</th>
                                    <th>{{$contact->dob}}</th>
                                    @guest @else<th><a data-toggle="modal"
                                           data-id="{{$contact->id}}"
                                           data-name="{{$contact->name}}"
                                           data-surname="{{$contact->surname}}"
                                           data-email="{{$contact->email}}"
                                           data-phone_number="{{$contact->phone_number}}"
                                           data-address="{{$contact->address}}"
                                           data-dob="{{$contact->dob}}"
                                           title="Add this item"
                                           class="open-edit-contact btn btn-primary"
                                           href="#EditContact"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <a data-toggle="modal"
                                           data-id="{{$contact->id}}"
                                           class="open-edit-contact btn btn-danger"
                                           href="#DeleteContact"><i class="fa fa-trash-o" aria-hidden="true"></i></a></th>@endguest
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $contacts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Edit-->
<div class="modal fade" id="EditContact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit contact</h5>
                    <h5 class="alert-danger" id="ValidationErrors"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <form id="form-edit-contact">
                <input type="text" hidden="hidden" class="form-control" name="contact_id" id="contact_id">
                <div class="form-group">
                    <span>name</span><span data-label="contact_name" class="col-2 col-form-label label-error"></span>
                    <input type="text" class="form-control" name="contact_name"  id="contact_name" placeholder="name">
                </div>
                <div class="form-group">
                    <span>surname</span><span data-label="contact_surname" class="col-2 col-form-label label-error"></span>
                    <input type="text" class="form-control" name="contact_surname"  id="contact_surname" placeholder="surname">
                </div>
                <div class="form-group">
                    <span>email</span><span data-label="contact_email" class="col-2 col-form-label label-error"></span>
                    <input type="text" class="form-control" name="contact_email"  id="contact_email" placeholder="email">
                </div>
                <div class="form-group">
                    <span>phone number</span><span data-label="contact_phone_number" class="col-2 col-form-label label-error"></span>
                    <input type="text" class="form-control" name="phone_number"  id="phone_number" placeholder="phone number">
                </div>
                <div class="form-group">
                    <span>address</span><span data-label="contact_address" class="col-2 col-form-label label-error"></span>
                    <input type="text" class="form-control" name="contact_address"  id="contact_address" placeholder="address">
                </div>
                <div class="form-group">
                    <span>date of birth</span><span data-label="contact_dob" class="col-2 col-form-label label-error"></span>
                    <input type="text" class="form-control" name="dob"  id="dob" placeholder="date of birth">
                </div>
                <div class="modal-footer">
                    <button type="button" class="edit-profile-button btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Edit-->
<div class="modal fade" id="DeleteContact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Want to delete ?</h5>
                    <h5 class="alert-danger" id="ValidationErrors"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route('contacts.delete')}}">
                    @csrf
                    <input type="text" hidden="hidden" class="form-control" name="contact_id" id="contact_id">
                    <div class="modal-footer">
                        <button type="submit" class="edit-profile-button btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Create-->
<div class="modal fade" id="CreateContact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Create contact</h5>
                    <h5 class="alert-danger" id="ValidationErrors"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-create-contact">
                    <input type="text" hidden="hidden" class="form-control" name="contact_id" id="contact_id">
                    <div class="form-group">
                        <span>name</span><span data-label="contact_name" class="col-2 col-form-label label-error"></span>
                        <input type="text" class="form-control" name="name" placeholder="name">
                    </div>
                    <div class="form-group">
                        <span>surname</span><span data-label="contact_surname" class="col-2 col-form-label label-error"></span>
                        <input type="text" class="form-control" name="surname" placeholder="surname">
                    </div>
                    <div class="form-group">
                        <span>email</span><span data-label="contact_email" class="col-2 col-form-label label-error"></span>
                        <input type="text" class="form-control" name="email" placeholder="email">
                    </div>
                    <div class="form-group">
                        <span>phone number</span><span data-label="contact_phone_number" class="col-2 col-form-label label-error"></span>
                        <input type="text" class="form-control" name="phone_number" placeholder="phone number">
                    </div>
                    <div class="form-group">
                        <span>address</span><span data-label="contact_address" class="col-2 col-form-label label-error"></span>
                        <input type="text" class="form-control" name="address"  placeholder="address">
                    </div>
                    <div class="form-group">
                        <span>date of birth</span><span data-label="contact_dob" class="col-2 col-form-label label-error"></span>
                        <input type="text" class="form-control" name="dob" placeholder="date of birth">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="create-profile-button btn btn-primary">Create</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

