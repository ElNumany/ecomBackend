@extends('layouts\app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Countries') }}</div>
                    <div class="card-body">
                        <div class="span">
                        </div>
                        <div class="row">
                            @foreach ($countries as $country)
                                <div class="col-md-3">
                                    <div class="alert alert-primary" role="alert">
                                        <span class="buttons-span">
                                            <span><a class="edit-uniit" data-countryname="{{ $country->name }}"
                                                    data-countryid="{{ $country->id }}"><i
                                                        class="far fa-edit"></i></a></span>
                                            <span><a class='delete-uniit' data-countryname="{{ $country->name }}"
                                                    data-countryid="{{ $country->id }}"><i
                                                        class="fas fa-trash"></i></a></span>
                                        </span>
                                        <h5>{{ $country->name }}</h5>
                                        <p>{{ $country->currency }}</p>
                                        <p>{{ $country->capital }}</p>
                                    </div>
                                </div>
                            @endforeach
                            {{ !is_null($showLinks) && $showLinks ? $countries->links() : '' }}
                        </div>
                        <!-- Search form -->
                        <form action="{{ route('search-countries') }}" method="GET">
                            @csrf
                            <input class="form-control form-control-sm mr-3 w-75" name="country_search" type="text"
                                placeholder="Search" aria-label="Search" id="country_search">
                            <button class="btn" type="submit"><i class="fas fa-search" aria-hidden="true"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
{{--TryToastHere--}}
@if (Session::has('message'))
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true"
        style="position: absolute; z-index: 99999; top: 5% ; right: 5%;">
        <div class="toast-header">
            <strong class="mr-auto">Countries</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            {{ Session::get('message') }}
        </div>
    </div>
@endif
{{--End Toast TryHere--}}

{{--try Modal Here--}}

{{--Delete Window--}}
<div class="modal delete-window" tabindex="-1" role="dialog" id="delete-window">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Countries!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('countries') }}" method="POST" style="position: relative">
                @csrf
                <div class="modal-body">
                    <p id="delete-message"></p>
                    {{--Hidden Section--}}
                    <span>
                        <input type="hidden" name="_method" value="delete" />
                        <input type="hidden" name="country_id" value="" id="country_id">
                        {{--End Hidden Section--}}
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{--Edit Window--}}
<div class="modal edit-window" tabindex="-1" role="dialog" id="edit-window">

    <form action="{{ route('countries') }}" method="POST">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Country</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="edit-message"></p>
                    <div class="form-group">
                        <label for="edi_tag_name">Country Name</label>
                        <input type="text" class="form-control" id="edit_country_id" name="country_name"
                            placeholder="Country Name" required>
                    </div>
                    <input type="hidden" name="country_name" id="edit_country_id">
                    <input type="hidden" name="_method" value="PUT" />

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close Without
                        Change</button>
                </div>

            </div>

        </div>
    </form>
</div>

{{--End try Modal Here--}}




{{--tryHereTooJavaScripts--}}
@section('scripts')


    {{--Start Modals JS--}}

    <script>
        function run() {
            if (window.jQuery) {
                $(document).ready(function() {
                    var $deleteUnit = $('.delete-unit');
                    var $deleteWindow = $('#delete-window');
                    var $countryID = $('#country_id');
                    var $deleteMessage = $('#delete-message');
                    $deleteUnit.on('click', function(element) {
                        element.preventDefault();
                        var countryID = $(this).data('countryid');
                        $countryID.val(countryID);
                        $deleteMessage.text('Are You Sure You Want To Delete this Country! ?');
                        $deleteWindow.modal('show');
                    });
                    var $editCountry = $('.edit-unit');
                    var $editWindow = $('#edit-window');
                    var $edit_country_name = $('#edit_country_name');
                    var $edit_country_id = $('#edit_country_id');
                    $editCountry.on('click', function(element) {
                        element.preventDefault();
                        var countryID = $(this).data('countryid');
                        var countryName = $(this).data('countryname');
                        $edit_country_name.val(countryName);
                        $edit_country_id.val(countryID);
                        $countryID.val(countryName);
                        $editWindow.modal('show');
                    });
                });
            } else {
                setTimeout(run, 50);
            }
        }

        run();

    </script>

    {{--End ModalsJS--}}
    {{--Start Toasts JS--}}
    @if (Session::has('message'))
        <script>
            function run() {
                if (window.jQuery) {
                    $(document).ready(function() {
                        var $toast = $('.toast').toast({
                            authohide: false,
                            delay: 2000
                        });
                        $toast.toast('show');
                    });
                } else {
                    setTimeout(run, 50);
                }
            }
            run();

        </script>
    @endif
@endsection
{{--End Toasts JS--}}
{{--End tryHereTooJS--}}
