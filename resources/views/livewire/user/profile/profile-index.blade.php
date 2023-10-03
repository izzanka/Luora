<div>
    <div class="mt-4">
        <div class="row">
            <div class="col-6">
                <div class="row">
                    <div class="col-3">
                        <span class="avatar avatar-xl rounded-circle" style="background-image: url(@if($user->image == null) 'https://ui-avatars.com/api/?name={{ $user->username }}&background=DE6060&color=fff&rounded=true&size=112' @else {{ asset($user->image) }} @endif)"></span>
                    </div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col-12">
                                <b style="font-size: 27px">
                                    {{ $user->username }}
                                </b>
                                @if($show)
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#profileModal">Edit profile</a>
                                @endif
                            </div>
                        </div>
                        <div>
                            <h3 class="text-secondary">
                                @if ($user->credential == null)
                                    @if($show)
                                        <a href="" data-bs-toggle="modal" data-bs-target="#profileModal">Add profile credential</a>
                                    @endif
                                @else
                                    {{ $user->credential }}
                                @endif
                            </h3>
                        </div>

                        <div>
                            <h4 class="text-secondary">
                                {{ $total_followers }} Followers &#8226; {{ $total_following }} Following
                            </h4>
                        </div>
                        @if(!$show)
                            <div>
                                @if(!$followed)
                                <button class="btn btn-pill btn-primary btn-sm" wire:click="follow">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="me-1 icon icon-tabler icon-tabler-user-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                        <path d="M16 19h6"></path>
                                        <path d="M19 16v6"></path>
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4"></path>
                                        </svg>
                                        Follow
                                    </button>
                                @else
                                <button class="btn btn-pill btn-primary btn-sm" wire:click="unfollow">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="me-1 icon icon-tabler icon-tabler-user-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                        <path d="M16 19h6"></path>
                                        <path d="M19 16v6"></path>
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4"></path>
                                        </svg>
                                        Following
                                    </button>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                <div class="mt-3 ms-1">
                    @if ($user->description == null)
                        @if($show)
                            <a href="" class="text-secondary" data-bs-toggle="modal" data-bs-target="#profileModal">Write a description about yourself</a>
                        @endif
                    @else
                        {{ $user->description }}
                    @endif
                </div>
                <div class="mt-4">
                    <div class="row text-center">
                        <div class="col-3">
                            <a href="" class="@if($answers) text-danger @else text-secondary @endif " wire:click.prevent="showAnswers">{{ $total_answers }} Answers</a>
                        </div>
                        <div class="col-3">
                            <a href="" class="@if($questions) text-danger @else text-secondary @endif" wire:click.prevent="showQuestions">{{ $total_questions }} Questions</a>
                        </div>
                        <div class="col-3">
                            <a href="" class="@if($user_followers) text-danger @else text-secondary @endif" wire:click.prevent="showFollowers">{{ $total_followers }} Followers</a>
                        </div>
                        <div class="col-3">
                            <a href="" class="@if($user_following) text-danger @else text-secondary @endif" wire:click.prevent="showFollowing">{{ $total_following }} Following</a>
                        </div>
                    </div>
                </div>
                <hr class="mt-3 mb-3">
                @if($answers)
                    @forelse ($answers as $answer)
                        <div>
                            <div>
                                <a href="{{ route('question.index', $answer->question->title_slug) }}" class="text-dark"><b>{{ $answer->question->title }}</b></a>
                            </div>
                            <div class="mt-1">
                                {{ $answer->answer }}
                            </div>
                            <hr class="mt-3 mb-3">
                        </div>
                    @empty
                        <div class="text-center">
                            No answers
                        </div>
                    @endforelse
                @endif
                @if($questions)
                    @forelse ($questions as $question)
                        <div>
                            <div>
                                <a href="{{ route('question.index', $question->title_slug) }}" class="text-dark"><b>{{ $question->title }}</b></a>
                            </div>
                            <hr class="mt-3 mb-3">
                        </div>
                    @empty
                        <div class="text-center">
                            No questions
                        </div>
                    @endforelse
                @endif
                @if($user_followers)
                    @forelse ($user_followers as $u_f)
                        <a href="">
                            <div class="row">
                                <div class="col-1">
                                    <span class="avatar avatar-sm rounded-circle" style="background-image: url(@if($u_f->image == null) 'https://ui-avatars.com/api/?name={{ $u_f->username }}&background=DE6060&color=fff&rounded=true&size=112' @else {{ asset($u_f->image) }} @endif)"></span>
                                </div>
                                <div class="col-11 mt-1">
                                    <span class="text-dark">{{ $u_f->username }}</span>
                                </div>
                            </div>
                        </a>
                        <hr class="mt-3 mb-3">
                    @empty
                        <div class="text-center">
                            No followers
                        </div>
                    @endforelse
                @endif
                @if($user_following)
                    @forelse ($user_following as $u_f)
                        <a href="">
                            <div class="row">
                                <div class="col-1">
                                    <span class="avatar avatar-sm rounded-circle" style="background-image: url(@if($u_f->image == null) 'https://ui-avatars.com/api/?name={{ $u_f->username }}&background=DE6060&color=fff&rounded=true&size=112' @else {{ asset($u_f->image) }} @endif)"></span>
                                </div>
                                <div class="col-11 mt-1">
                                    <span class="text-dark">{{ $u_f->username }}</span>
                                </div>
                            </div>
                        </a>
                        <hr class="mt-3 mb-3">
                    @empty
                        <div class="text-center">
                            No following
                        </div>
                    @endforelse
                @endif
            </div>
            <div class="col-2">

            </div>
            <div class="col-4">
                <div>
                    Credentials & Highlights
                    @if($show)
                    <span class="float-end">
                        <svg role="button" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                            <path d="M16 5l3 3"></path>
                        </svg>
                    </span>
                    @endif
                    <hr class="mt-3 mb-3">

                    <div>
                        @if (!$user->employment()->exists() && $show)
                        <svg xmlns="http://www.w3.org/2000/svg" class="me-1 icon icon-tabler icon-tabler-briefcase" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M3 7m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z"></path>
                            <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2"></path>
                            <path d="M12 12l0 .01"></path>
                            <path d="M3 13a20 20 0 0 0 18 0"></path>
                        </svg>
                            <a href="" data-bs-toggle="modal" data-bs-target="#employmentModal">Add employment credential</a>
                        @else
                            {{ $employment_credential }}
                        @endif
                    </div>
                    <div class="mt-3">
                        @if (!$user->education()->exists() && $show)
                        <svg xmlns="http://www.w3.org/2000/svg" class="me-1 icon icon-tabler icon-tabler-school" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M22 9l-10 -4l-10 4l10 4l10 -4v6"></path>
                            <path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4"></path>
                        </svg>
                            <a href="" data-bs-toggle="modal" data-bs-target="#educationModal">Add education credential</a>
                        @else
                            {{ $education_credential }}
                        @endif
                    </div>
                    <div class="mt-3">
                        @if (!$user->location()->exists() && $show)
                        <svg xmlns="http://www.w3.org/2000/svg" class="me-1 icon icon-tabler icon-tabler-map-pin" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                            <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z"></path>
                        </svg>
                            <a href="" data-bs-toggle="modal" data-bs-target="#locationModal">Add location credential</a>
                        @else
                            {{ $location_credential }}
                        @endif
                    </div>
                    <div class="mt-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="me-1 icon icon-tabler icon-tabler-calendar" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z"></path>
                            <path d="M16 3v4"></path>
                            <path d="M8 3v4"></path>
                            <path d="M4 11h16"></path>
                            <path d="M11 15h1"></path>
                            <path d="M12 15v3"></path>
                        </svg>
                        Joined {{ $user->created_at->format('d M Y') }}
                    </div>
                </div>
                <div class="mt-4">
                    Knows about
                    @if ($show)
                    <span class="float-end">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                            <path d="M16 5l3 3"></path>
                        </svg>
                    </span>
                    @endif

                    <hr class="mt-3 mb-3">
                </div>
            </div>
        </div>
    </div>
    @if($show)
    <div class="modal" id="profileModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form wire:submit="updateProfile">
                    <div class="modal-header">
                        <b>Edit profile</b>
                    </div>
                    <div class="modal-body">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" wire:model="username" />
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <label class="form-label mt-3">Credential</label>
                        <input type="text" class="form-control @error('credential') is-invalid @enderror" wire:model="credential" />
                        @error('credential')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <label class="form-label mt-3">Description</label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror" wire:model="description" />
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-ghost-secondary btn-pill" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-pill">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- <div class="modal" id="employmentModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form wire:submit="addEmployment">
                    <div class="modal-header">
                        <b>Edit credentials</b>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-header">
                                <svg xmlns="http://www.w3.org/2000/svg" class="me-2 icon icon-tabler icon-tabler-briefcase" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M3 7m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z"></path>
                                    <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2"></path>
                                    <path d="M12 12l0 .01"></path>
                                    <path d="M3 13a20 20 0 0 0 18 0"></path>
                                </svg>
                                Add employment credential
                            </div>
                            <div class="card-body">
                                <label class="form-label">Position</label>
                                <input type="text" class="form-control @error('position') is-invalid @enderror" wire:model.blur="position" />
                                @error('position')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <label class="form-label mt-3">Company</label>
                                <input type="text" class="form-control @error('company') is-invalid @enderror" wire:model.blur="company"/>
                                @error('company')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <label class="form-label mt-3">Start Year</label>
                                <select wire:model.blur="employment_start_year" id="employment-start-year" class="form-select">
                                    @if ($employment_start_year != null)
                                        <option value="{{ $employment_start_year }}" selected>{{ $employment_start_year }}</option>
                                        <option value="" disabled>----</option>
                                    @endif
                                </select>
                                @error('employment_start_year')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <label class="form-label mt-3">End Year</label>
                                <select wire:model.blur="employment_end_year" id="employment-end-year" class="form-select">
                                    @if ($employment_end_year != null)
                                        <option value="{{ $employment_end_year }}" selected>{{ $employment_end_year }}</option>
                                        <option value="" disabled>----</option>
                                    @endif
                                </select>
                                @error('employment_end_year')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror



                                <label class="form-check mt-3">
                                    <input type="checkbox" class="form-check-input" wire:model.blur="employment_currently"/>
                                    <span class="form-check-label">I currently work here</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-ghost-secondary btn-pill" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-pill">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="educationModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form wire:submit="addQuestion">
                    <div class="modal-header">
                        <b>Edit credentials</b>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-header">
                                <svg xmlns="http://www.w3.org/2000/svg" class="me-2 icon icon-tabler icon-tabler-school" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M22 9l-10 -4l-10 4l10 4l10 -4v6"></path>
                                    <path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4"></path>
                                </svg>
                                Add education credential
                            </div>
                            <div class="card-body">
                                <label class="form-label">School</label>
                                <input type="text" class="form-control @error('school') is-invalid @enderror" wire:model.blur="school" />
                                @error('school')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label class="form-label mt-3">Major</label>
                                <input type="text" class="form-control @error('major') is-invalid @enderror" wire:model.blur="major" />
                                @error('major')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label class="form-label mt-3">Degree Type</label>
                                <input type="text" class="form-control @error('degree_type') is-invalid @enderror" wire:model.blur="degree_type" />
                                @error('degree_type')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label class="form-label mt-3">Graduation Year</label>
                                <input type="text" class="form-control @error('graduation_year') is-invalid @enderror" wire:model.blur="graduation_year" />
                                @error('graduation_year')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-ghost-secondary btn-pill" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-pill">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="locationModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form wire:submit="addQuestion">
                    <div class="modal-header">
                        <b>Edit credentials</b>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-header">
                                <svg xmlns="http://www.w3.org/2000/svg" class="me-2 icon icon-tabler icon-tabler-map-pin" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                    <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z"></path>
                                </svg>
                                Add location credential
                            </div>
                            <div class="card-body">
                                <label class="form-label">Location</label>
                                <input type="text" class="form-control @error('location') is-invalid @enderror" wire:model.blur="location"/>
                                @error('location')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <label class="form-label mt-3">Start Year</label>
                                <input type="text" class="form-control @error('location_start_year') is-invalid @enderror" wire:model.blur="location_start_year"/>
                                @error('location_start_year')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <label class="form-label mt-3">End Year</label>
                                <input type="text" class="form-control @error('location_end_year') is-invalid @enderror" wire:model.blur="location_end_year"/>
                                @error('location_end_year')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <label class="form-check mt-3">
                                    <input type="checkbox" class="form-check-input" wire:model.blur="location_currently"/>
                                    <span class="form-check-label">I currently live here</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-ghost-secondary btn-pill" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-pill">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
    {{--
    <script>
        let employmentStartYearDropdown = document.getElementById('employment-start-year');
        let employmentEndYearDropdown = document.getElementById('employment-end-year');

        function addEmploymentYear()
        {
            yearDropdown(employmentStartYearDropdown);
            yearDropdown(employmentEndYearDropdown);
        }

        function yearDropdown(dropdown) {
            let currentYear = new Date().getFullYear();
            let earliestYear = 2000;
            while (currentYear >= earliestYear) {
                let dateOption = document.createElement('option');
                dateOption.text = currentYear;
                dateOption.value = currentYear;
                dropdown.add(dateOption);
                currentYear -= 1;
            }
        }
    </script> --}}
    @endif
</div>
