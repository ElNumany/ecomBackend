@extends('layouts\app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Reviews') }}</div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($reviews as $review)
                                <div class="col-md-3">
                                    <div class="alert alert-primary" role="alert">
                                        <span class="buttons-span">
                                            <span><a class='delete-unit' data-reviewname="{{ $review->review }}"
                                                    data-reviewid="{{ $review->id }}"><i
                                                        class="fas fa-trash"></i></a></span>
                                        </span>
                                        <p>User Review : {{ $review->customer->formatedName() }}</p>
                                        <p>About Product : {{ $review->product->title }}</p>

                                        <p>Stars :
                                            @php
                                            $total = 5;
                                            $currentStars = $review->stars;
                                            $remainingStars = $total - $currentStars;
                                            @endphp
                                            @for ($i = 0; $i < $review->stars; $i++)
                                                <i class="fas fa-star"></i>
                                            @endfor

                                            @for ($i = 0; $i < $remainingStars; $i++)
                                                <i class="far fa-star"></i>
                                            @endfor
                                        </p>
                                        <p>Review: {{ $review->review }}</p>
                                        <p>Date: {{ $review->humanFormatedDate() }}</p>
                                    </div>
                                </div>
                            @endforeach
                            {{ $reviews->links() }}
                        </div>
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
                <strong class="mr-auto">Review</strong>
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
                    <h5 class="modal-title">Delete Review!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('reviews') }}" method="POST" style="position: relative">
                    @csrf

                    <div class="modal-body">
                        <p id="delete-message"></p>
                        {{--Hidden Section--}}
                        <span>
                            <input type="hidden" name="_method" value="delete" />
                            <input type="hidden" name="review_id" value="" id="review_id">
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
                        var $reviewID = $('#review_id');
                        var $deleteMessage = $('#delete-message');
                        $deleteUnit.on('click', function(element) {
                            element.preventDefault();
                            var reviewID = $(this).data('reviewid');
                            $reviewID.val(reviewID);
                            $deleteMessage.text('Are You Sure You Want To Delete this review ?');
                            $deleteWindow.modal('show');
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
