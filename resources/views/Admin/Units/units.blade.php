@extends('layouts\app')
@section('content')
<div class="container">
<div class="col-md-12">
<div class="row">

</div>
    <div class="card" >

                <div class="card-header">{{ __('Units') }}</div>
                <div class="card-body">
                <div class="span">
                    <form action="{{route('units')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="unit_name">Unit Name</label>
                        <input type="text" class="form-control" id="unit_name" name="unit_name" placeholder="Unit Name" required>
                    </div>
                    <div class="form-group">
                        <label for="unit_code">Unit Code</label>
                        <input type="text" class="form-control" id="unit_code" name="unit_code" placeholder="Unit Code" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Unit</button>
                    </form>
                    </div>
                    <div class="row">
                        @foreach($units as $unit)
                    <div class="col-md-3">
                    <div class="alert alert-primary" role="alert">
                    <span class="buttons-span">
                    <span><a class="edit-unit"
                    data-unitname="{{$unit-> unit_name}}"
                    data-unitcode="{{$unit -> unit_code }}"
                    data-unitid="{{$unit->id}}"
                    ><i class="far fa-edit"></i></a></span>
                    <span><a class='delete-unit'
                    data-unitname="{{$unit-> unit_name}}"
                    data-unitcode="{{$unit -> unit_code }}"
                    data-unitid="{{$unit->id}}"><i  class="fas fa-trash"></i></a></span>
                    </span>
                    <p>{{$unit -> unit_name }} , {{$unit -> unit_code }}</p>
                    </div>
                    </div>
                @endforeach
                {{ (!is_null($showLinks) && $showLinks) ? $units->links() : '' }}
            </div>
            </div>
            <div class="col-md-6">
            <!-- Search form -->
            <form action="{{route('search-units')}}" method="GET">
            @csrf
            <input class="form-control form-control-sm mr-3 w-75" name="unit_search" type="text" placeholder="Search"
            aria-label="Search" id="unit_search">
            <button class="btn" type="submit"><i class="fas fa-search" aria-hidden="true"></i></button>
            </form>
            </div>
            </div>
        </div>
@endsection
    {{--TryToastHere--}}
    @if (Session::has('message'))
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="position: absolute; z-index: 99999; top: 5% ; right: 5%;">
    <div class="toast-header">
        <strong class="mr-auto">Unit</strong>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
    <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
            {{Session::get('message')}}
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
        <h5 class="modal-title">Delete Unit!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
        <form action="{{route('units')}}" method="POST" style="position: relative">
@csrf
    <div class="modal-body">
        <p id="delete-message"></p>
        {{--Hidden Section--}}
        <span>
        <input type="hidden" name="_method" value="delete" />
        <input type="hidden" name="unit_id" value="" id="unit_id">
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

<form action="{{route('units')}}" method="POST" >
    @csrf
<div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Edit Unit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <p id="edit-message"></p>

<div class="form-group">
    <label for="edi_unit_name">Unit Name</label>
    <input type="text" class="form-control" id="edit_unit_name" name="unit_name" placeholder="Unit Name" required>
</div>
<div class="form-group">
    <label for="edit_unit_code">Unit Code</label>
    <input type="text" class="form-control" id="edit_unit_code" name="unit_code" placeholder="Unit Code" required>
</div>
<input type="hidden" name="unit_id" id="edit_unit_id">
<input type="hidden" name="_method" value="PUT" />

</div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close Without Change</button>
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
            var $deleteWindow =$('#delete-window');
            var $unitID = $('#unit_id');
            var $deleteMessage = $('#delete-message');
            $deleteUnit.on('click' , function(element){
            element.preventDefault();
            var unitID = $(this).data('unitid');
            var unitName = $(this).data('unitname');
            var unitCode = $(this).data('unitcode');
            $unitID.val(unitID);
            $deleteMessage.text('Are You Sure You Want To Delete '  + unitName + " With Code " + unitCode + "?");
            $deleteWindow.modal('show');
            });
            var $editUnit =$('.edit-unit');
            var $editWindow = $('#edit-window');
            var $editmessage = $('#edit-message');
            var $edit_unit_name = $('#edit_unit_name');
            var $edit_unit_code = $('#edit_unit_code');
            var $edit_unit_id = $('#edit_unit_id');
            $editUnit.on('click' ,function(element){
            element.preventDefault();
            var unitID = $(this).data('unitid');
            var unitName = $(this).data('unitname');
            var unitCode = $(this).data('unitcode');
            $edit_unit_code.val(unitCode);
            $edit_unit_name.val(unitName);
            $edit_unit_id.val(unitID);
            $unitID.val(unitID);
            $editmessage.text('Updating '  + unitName + " With Code " + unitCode + " Data");
            $editWindow.modal('show');
            });
        });
    }
    else {
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
                authohide : false,
                delay : 2000
            });
                $toast.toast('show');
            });
        }
        else {
            setTimeout(run, 50);
        }
    }
    run();
</script>
@endif
@endsection
{{--End Toasts JS--}}
{{--End tryHereTooJS--}}



{{-- <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
    <strong class="mr-auto">Bootstrap</strong>
    <small>11 mins ago</small>
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="toast-body">
    @if (Session::has('message'))
        {{Session::get('message')}}
    @endif
    </div>
</div>






(document).on('ready', function() {
    var $deleteUnit = $('.delete-unit');
    var $deleteWindow = $('#delete-window')
    $deleteUnit.on('click' , function( element ){
        element.preventDefault();
        $deleteWindow.modal('show')

    })
});





<script>
$(document).on('ready', function($){
    var $toast = $('.toast').toast({
        authohide:false
    });
    $('.toast').toast('show');
});
    </script>
@endif





    <div class="modal edit-window" tabindex="-1" role="dialog" id="delete-window">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>

    <div class="modal delete-window" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>
    @if(Session::has('toasts'))
    <!-- Messenger http://github.hubspot.com/messenger/ -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script type="text/javascript">
        toastr.options = {
            "closeButton": true,
            "newestOnTop": true,
            "positionClass": "toast-top-right"
        };
        @foreach(Session::get('toasts') as $toast)
            toastr["{{ $toast['level'] }}"]("{{ $toast['message'] }}","{{ $toast['title'] }}");
        @endforeach
    </script>
@endif
    --}}
