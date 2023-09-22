<div>
    <div class="card mt-3">
        <div class="card-body">
            <div>
                <div class="row">
                    <span class="avatar rounded-circle ms-2" style="background-image: url(@if($answer->user->image == null) 'https://ui-avatars.com/api/?name={{ $answer->user->username }}&background=DE6060&color=fff&rounded=true&size=56' @else {{ asset($answer->user->image) }} @endif)"></span>
                    <div class="col-11">
                        <a href="" class="text-dark">
                            <b style="font-size: 15px">{{ $answer->user->username }}</b>
                        </a>
                        @if(auth()->id() != $answer->user->id) &#8226; <a href="" style="font-size: 13px">Follow</a> @endif
                        <div class="text-secondary" style="font-size: 13px">
                            {{ $answer->user->credential ?? 'web developer' }} &#8226; <a href="" class="text-secondary">{{ $answer->created_at->diffForHumans() }}</a>
                        </div>
                    </div>
                </div>
            </div>
            @if ($from == 'home')
                <div class="mt-3">
                    <a href="{{ route('question.index', $answer->question->title_slug) }}" class="text-dark"><b style="font-size: 16px">{{ $answer->question->title }}</b></a>
                </div>
            @endif
            <p class="mt-3" style="font-size: 15px">
                {{ $answer->answer }}
            </p>
            <div class="mt-3">
                <small class="text-secondary">{{ $answer->total_views }} views</small>
            </div>
            <div class="mt-2">
                <button wire:click="votes('up')" class="btn btn-pill btn-outline-secondary @if($vote == 'up') active border-secondary @endif">
                    <div wire:loading.remove wire:target="votes('up')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-big-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M9 20v-8h-3.586a1 1 0 0 1 -.707 -1.707l6.586 -6.586a1 1 0 0 1 1.414 0l6.586 6.586a1 1 0 0 1 -.707 1.707h-3.586v8a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                         </svg>
                    </div>
                    <div wire:loading wire:target="votes('up')">
                        <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                    </div>
                    Upvote &#8226; {{ $total_upvotes }}
                </button>
                <button wire:click="votes('down')" class="btn btn-pill btn-outline-secondary @if($vote == 'down') active border-secondary @endif">
                    <div wire:loading.remove wire:target="votes('down')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-big-down" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M15 4v8h3.586a1 1 0 0 1 .707 1.707l-6.586 6.586a1 1 0 0 1 -1.414 0l-6.586 -6.586a1 1 0 0 1 .707 -1.707h3.586v-8a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1z"></path>
                         </svg>
                    </div>
                    <div wire:loading wire:target="votes('down')">
                        <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                    </div>
                    Downvote &#8226; {{ $total_downvotes }}
                </button>
                <button class="btn btn-pill btn-ghost-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M3 20l1.3 -3.9c-2.324 -3.437 -1.426 -7.872 2.1 -10.374c3.526 -2.501 8.59 -2.296 11.845 .48c3.255 2.777 3.695 7.266 1.029 10.501c-2.666 3.235 -7.615 4.215 -11.574 2.293l-4.7 1"></path>
                    </svg>
                    0
                </button>
                <button class="btn btn-pill btn-ghost-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-share" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M6 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                        <path d="M18 6m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                        <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                        <path d="M8.7 10.7l6.6 -3.4"></path>
                        <path d="M8.7 13.3l6.6 3.4"></path>
                    </svg>
                    0
                </button>
            </div>
        </div>
    </div>
</div>
