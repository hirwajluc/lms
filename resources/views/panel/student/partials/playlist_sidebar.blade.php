<div class="panel-sidebar panel-sidebar2">
    <div class="panel-sidebar-close-main">
        <!-- Mobile Device Close Icon -->
        <div class="close-sidebar"><i class="ri-close-line"></i></div>

        <!-- video-playlist -->
        <div class="video-playlist white-bg mb-24">

            <!-- Course module & Live class TAB -->
            @if (module('LiveClass'))
                <div class="tab-menu text-center mb-40">
                    <ul class="listing">
                        <li class="single-list">
                            <a @if (@$enroll->course->firstLesson) href="{{ route('student.course.learn', [$enroll->course->slug, encryptFunction($enroll->course->firstLesson->id)]) }}" @else href="javascript:void(0)" @endif
                                class="@if (!@$data['is_live_class']) active @endif" data-rel="tab-1">
                                {{ ___('frontend.Lessons') }}
                            </a>
                        </li>
                        @if (module('LiveClass'))
                            <li class="single-list">
                                <a href="{{ route('student.course.live_class', $enroll->id) }}"
                                    class="@if (@$data['is_live_class']) active @endif">
                                    {{ ___('live_class.Live_Classes') }}
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            @endif
            <!--End-of  Course module & Live class TAB -->


            <!-- Course module CONTENT -->
            @if (!@$data['is_live_class'] && @$enroll->course->sections)
                <div class="singleTab-items d-block" id="tab-1" >
                    <!--Course module Playlist -->
                    <div class="listing-video-wrapper ">
                        <div class="accordion" id="accordionExample2">
                            <!-- Single  -->
                            @foreach ($enroll->course->sections as $key => $section)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $key }}">
                                        <button class="accordion-button " type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $key }}" aria-expanded="true"
                                            aria-controls="collapse{{ $key }}">
                                            <h5 class="title"> {{ @$section->title }}</h5>
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $key }}"
                                        class="accordion-collapse collapse {{ in_array(@$data['lesson_id'], @$section->allLesson->pluck('id')->toArray()) ? 'show' : '' }}"
                                        aria-labelledby="heading{{ $key }}"
                                        data-bs-parent="#accordionExample2">
                                        <div class="accordion-body">
                                            <!-- listing video -->
                                            <ul class="listing-video">
                                                <!-- Single video -->
                                                @foreach ($section->allLesson as $lesson)
                                                    <li
                                                        class="single-list {{ @$lesson->id == @$data['lesson_id'] ? ' active' : '' }} ">
                                                        <div class="mb-8  d-flex align-items-center w-100">
                                                            @if (@$lesson->is_quiz)
                                                                <div class="check-remember-me">
                                                                    <label>
                                                                        <input class="ot-checkbox" type="checkbox"
                                                                            {{ in_array(@$lesson->id, $enroll->completed_quizzes ?? []) ? 'checked' : '' }} />
                                                                        <span class="ot-checkmark"></span>
                                                                    </label>
                                                                </div>
                                                            @else
                                                                <div class="check-remember-me" id="lesson-progress"
                                                                    data-id="{{ encryptFunction(@$lesson->id) }}">
                                                                    <label>
                                                                        <input class="ot-checkbox" type="checkbox"
                                                                            name="lesson_id[]"
                                                                            value="{{ encryptFunction(@$lesson->id) }}"
                                                                            {{ in_array(@$lesson->id, $enroll->completed_lessons ?? []) ? 'checked' : '' }} />
                                                                        <span class="ot-checkmark"></span>
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            <div class="d-flex align-items-center w-100"
                                                                id="lesson-start"
                                                                data-id="{{ encryptFunction(@$lesson->id) }}">
                                                                <div class="play-btn">
                                                                    @if (@$lesson->is_quiz)
                                                                        <i class="ri-question-line"></i>
                                                                    @else
                                                                        @if (in_array(@$lesson->lesson_type, ['Youtube', 'Vimeo', 'GoogleDrive', 'VideoFile']))
                                                                            <i class="ri-play-circle-line"></i>
                                                                        @elseif(@$lesson->lesson_type == 'Text')
                                                                            <i class="ri-text"></i>
                                                                        @elseif(@$lesson->lesson_type == 'ImageFile')
                                                                            <i class="ri-image-fill"></i>
                                                                        @elseif(@$lesson->lesson_type == 'DocumentFile' && @$lesson->attachment_type == 1)
                                                                            <i class="ri-file-pdf-line"></i>
                                                                        @elseif(@$lesson->lesson_type == 'DocumentFile' && @$lesson->attachment_type == 2)
                                                                            <i class="ri-file-text-fill"></i>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                                <h6 class="title"> {{ @$lesson->title }} </h6>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                                <!-- Single video -->
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <!-- Single -->
                        </div>
                    </div>
                    <!-- End-of Course module Playlist -->
                </div>
                <!--End-of Course module CONTENT -->
            @endif
            @if (@$data['is_live_class'] && module('LiveClass'))
                @include('liveclass::playlist.live_class_list')
            @endif

        </div>
        <!-- End-of playlist -->

    </div>
</div>
