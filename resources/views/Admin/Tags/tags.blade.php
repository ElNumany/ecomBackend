@extends('layouts\app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Units') }}</div>
                <div class="card-body">
                    <form action="{{route('tags')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="tag_name">Tag Name</label>
                            <input type="text" class="form-control" id="tag_name" name="tag_name" placeholder="Tag Name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add New Tag</button>
                        </form>
                        </div>
                    <div class="row">
                        @foreach($tags as $tag)
                    <div class="col-md-3">
                    <div class="alert alert-primary" role="alert">
                        <span class="buttons-span">
                            <span><a class="edit-unit"
                            data-tagname="{{$tag-> tag}}"
                            data-tagid="{{$tag->id}}"
                            ><i class="far fa-edit"></i></a></span>
                            <span><a class='delete-unit'
                            data-tagname=""="{{$tag-> tag}}"
                            data-tagid="{{$tag->id}}"><i  class="fas fa-trash"></i></a></span>
                            </span>
                        <p>{{$tag -> tag }} </p>
                    </div>
                    </div>
                @endforeach
                    </div>
                    {{ (!is_null($showLinks) && $showLinks) ? $tags->links() : '' }}
                    <!-- Search form -->
            <form action="{{route('search-tags')}}" method="GET">
                @csrf
                <input class="form-control form-control-sm mr-3 w-75" name="tag_search" type="text" placeholder="Search for Tag"
                aria-label="Search" id="tag_search">
                <button class="btn" type="submit"><i class="fas fa-search" aria-hidden="true"></i></button>
                </form>
                </div>

            </div>
    </div>
</div>
@endsection


    {{--TryToastHere--}}
    @if (Session::has('message'))
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="position: absolute; z-index: 99999; top: 5% ; right: 5%;">
    <div class="toast-header">
        <strong class="mr-auto">Tag</strong>
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
            <h5 class="modal-title">Delete Tag!</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <form action="{{route('tags')}}" method="POST" style="position: relative">
    @csrf
        <div class="modal-body">
            <p id="delete-message"></p>
            {{--Hidden Section--}}
            <span>
            <input type="hidden" name="_method" value="delete" />
            <input type="hidden" name="tag_id" value="" id="tag_id">
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

    <form action="{{route('tags')}}" method="POST" >
        @csrf
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Tag</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p id="edit-message"></p>

    <div class="form-group">
        <label for="edi_tag_name">Tag Name</label>
        <input type="text" class="form-control" id="edi_tag_name" name="tag_name" placeholder="Tag Name" required>
    </div>
    <input type="hidden" name="tag_id" id="edit_tag_id">
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
            var $tagID = $('#tag_id');
            var $deleteMessage = $('#delete-message');
            $deleteUnit.on('click' , function(element){
            element.preventDefault();
            var tagID = $(this).data('tagid');
            $tagID.val(tagID);
            $deleteMessage.text('Are You Sure You Want To Delete this Tag ?');
            $deleteWindow.modal('show');
            });
            var $editTag =$('.edit-unit');
            var $editWindow = $('#edit-window');
            var $edit_tag_name = $('#edi_tag_name');
            var $edit_tag_id = $('#edit_tag_id');
            $editTag.on('click' ,function(element){
            element.preventDefault();
            var tagID = $(this).data('tagid');
            var tagName = $(this).data('tagname');
            $edit_tag_name.val(tagName);
            $edit_tag_id.val(tagID);
            $tagID.val(tagID);
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
