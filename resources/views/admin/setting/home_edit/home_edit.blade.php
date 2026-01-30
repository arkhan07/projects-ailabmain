@php
    $page = App\Models\Builder_page::where('id', $id)->first();
    if (!$page) {
        abort(404, 'Page not found');
    }
    $home_page_identifire = $page->identifier;
@endphp
<form action="{{ route('admin.update.home', ['id' => $id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="type" value="{{ $home_page_identifire }}">
    @if ($home_page_identifire == 'cooking')
        <h5 class="title mt-4 mb-3">{{ get_phrase('Become An Instructor') }}</h5>
        <div class="row">
            <div class="col-md-12">
                @php
                    $instructor_speech = json_decode(get_homepage_settings('cooking'));
                @endphp
                <div id="motivational_speech_area">
                    <div id="blank_motivational_speech_field">
                        <div class="d-flex mt-2 border-top pt-2">
                            <div class="flex-grow-1 px-2 mb-3">
                                <div class="fpb-7 mb-3">
                                    <label class="form-label ol-form-label">{{ get_phrase('Title') }}</label>
                                    <input type="text" class="form-control ol-form-control" name="title" value="{{ $instructor_speech->title ?? '' }}" placeholder="Enter a title" required>
                                </div>
                                <div class="fpb-7 mb-3">
                                    <label class="form-label ol-form-label">{{ get_phrase('Description') }}</label>
                                    <textarea name="description" class="form-control ol-form-control" placeholder="{{ get_phrase('Description') }}" required>{{ $instructor_speech->description ?? '' }}</textarea>
                                </div>
                                <div class="fpb-7 mb-3">
                                    <label class="form-label ol-form-label">{{ get_phrase('Video Url') }}</label>
                                    <input type="text" class="form-control ol-form-control" name="video_url" value="{{ $instructor_speech->video_url ?? '' }}" placeholder="enter a video url" required>
                                </div>
                                <div class="fpb-7 mb-3">
                                    <label class="form-label ol-form-label">{{ get_phrase('Image') }}</label>
                                    <div class="custom-file">
                                        <input name="previous_image" type="hidden" value="{{ $instructor_speech->image ?? '' }}">
                                        <input type="file" class="form-control ol-form-control" name="image" value="{{ $instructor_speech->image ?? '' }}" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fpb-7 mb-2 flex-grow-1 px-2">
                    <button type="submit" class="btn ol-btn-primary">{{ get_phrase('Save changes') }}</button>
                </div>
            </div>
        </div>
    @elseif($home_page_identifire == 'university')
        <div class="row">
            <div class="col-md-12">
                @php
                    $university = json_decode(get_homepage_settings('university'));
                @endphp
                <h5 class="title mt-4 mb-3">{{ get_phrase('About Us Image') }}</h5>
                <div id="motivational_speech_area">
                    <div id="blank_motivational_speech_field">
                        <div class="d-flex mt-2 border-top pt-2">
                            <div class="flex-grow-1 px-2 mb-3">
                                <div class="fpb-7 mb-3">
                                    <label class="form-label ol-form-label">{{ get_phrase('Image') }}</label>
                                    <div class="custom-file">
                                        <input name="previous_image" type="hidden" value="{{ $university->image ?? '' }}">
                                        <input type="file" class="form-control ol-form-control" name="image" value="{{ $university->image ?? '' }}" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <h5 class="title mt-4 mb-3">{{ get_phrase('Faq  Image') }}</h5>
                <div id="motivational_speech_area">
                    <div id="blank_motivational_speech_field">
                        <div class="d-flex mt-2 border-top pt-2">
                            <div class="flex-grow-1 px-2 mb-3">
                                <div class="fpb-7 mb-3">
                                    <label class="form-label ol-form-label">{{ get_phrase('Faq Image') }}</label>
                                    <div class="custom-file">
                                        <input name="previous_faq_image" type="hidden" value="{{ $university->faq_image ?? '' }}">
                                        <input type="file" class="form-control ol-form-control" name="faq_image" value="{{ $university->faq_image ?? '' }}" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <h5 class="title mt-4 mb-3">{{ get_phrase('Slider image & video link') }}</h5>
                <div class="row">
                    <div class="col-6">
                        <button type="button" onclick="addSliderImageField()" class="btn ol-btn-primary"><i class="fi-rr-plus-small"></i> {{ get_phrase('Add Image') }}</button>
                    </div>
                    <div class="col-6">
                        <button type="button" onclick="addSliderVideoField()" class="btn ol-btn-primary"><i class="fi-rr-plus-small"></i> {{ get_phrase('Add Video Link') }}</button>
                    </div>
                </div>

                <div id="slider_area">
                    @php
                        $university = json_decode(get_homepage_settings('university'));
                        $slider_items = json_decode($university->slider_items ?? '{}', true) ?? [];
                    @endphp
                    @foreach ($slider_items as $key => $slider_item)
                        @if (file_exists(public_path($slider_item)))
                            <div class="d-flex mt-2 border-top pt-2 align-items-center">
                                <img width="50px" src="{{ asset($slider_item) }}" alt="">
                                <div class="flex-grow-1 px-2 mb-3">
                                    <div class="fpb-7 mb-3">
                                        <label class="form-label ol-form-label">{{ get_phrase('Image') }}</label>
                                        <div class="custom-file">
                                            <input type="hidden" value="{{$slider_item}}" class="form-control ol-form-control" name="previous_slider_items[]" >
                                            <input type="hidden" value="{{$slider_item}}" class="form-control ol-form-control" name="slider_items[]">
                                            <input type="file" class="form-control ol-form-control" name="slider_items[]" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-danger" onclick="$(this).parent().remove();"><i class="fi-rr-minus-small"></i></button>
                            </div>
                        @else
                            <div class="d-flex mt-2 border-top pt-2 align-items-center">
                                <div class="flex-grow-1 px-2 mb-3">
                                    <div class="fpb-7 mb-3">
                                        <label class="form-label ol-form-label">{{ get_phrase('Video Link') }} <small>({{get_phrase('Youtube')}} & {{get_phrase('HTML5')}})</small></label>
                                        <div class="custom-file">
                                            <input type="hidden" value="{{$slider_item}}" class="form-control ol-form-control" name="previous_slider_items[]" >
                                            <input type="text" value="{{$slider_item}}" class="form-control ol-form-control" name="slider_items[]">
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-danger" onclick="$(this).parent().remove();"><i class="fi-rr-minus-small"></i></button>
                            </div>
                        @endif
                    @endforeach
                </div>

                <hr>

                <div class="fpb-7 mb-2 flex-grow-1 mt-3">
                    <button type="submit" class="btn ol-btn-primary">{{ get_phrase('Save changes') }}</button>
                </div>
            </div>
        </div>
    @elseif($home_page_identifire == 'development')
        <div class="row">
            <h5 class="title mt-4 mb-3">{{ get_phrase('About Us') }}</h5>
            <div class="col-md-12">
                @php
                    $development = json_decode(get_homepage_settings('development'));
                @endphp
                <div id="motivational_speech_area">
                    <div id="blank_motivational_speech_field">
                        <div class="d-flex mt-2 border-top pt-2">
                            <div class="flex-grow-1 px-2 mb-3">
                                <div class="fpb-7 mb-3">
                                    <label class="form-label ol-form-label">{{ get_phrase('Title') }}</label>
                                    <input type="text" class="form-control ol-form-control" name="title" value="{{ $development->title ?? '' }}" placeholder="Enter a title" required>
                                </div>
                                <div class="fpb-7 mb-3">
                                    <label class="form-label ol-form-label">{{ get_phrase('Description') }}</label>
                                    <textarea name="description" class="form-control ol-form-control" placeholder="{{ get_phrase('Description') }}" required>{{ $development->description ?? '' }}</textarea>
                                </div>
                                <div class="fpb-7 mb-3">
                                    <label class="form-label ol-form-label">{{ get_phrase('Image') }}</label>
                                    <div class="custom-file">
                                        <input name="previous_image" type="hidden" value="{{ $development->image ?? '' }}">
                                        <input type="file" class="form-control ol-form-control" name="image" value="{{ $development->image ?? '' }}" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fpb-7 mb-2 flex-grow-1 px-2">
                    <button type="submit" class="btn ol-btn-primary">{{ get_phrase('Save changes') }}</button>
                </div>
            </div>
        </div>
    @elseif($home_page_identifire == 'kindergarden')
        <div class="row">
            <h5 class="title mt-4 mb-3">{{ get_phrase('About Us') }}</h5>
            <div class="col-md-12">
                @php
                    $kindergarden = json_decode(get_homepage_settings('kindergarden'));
                @endphp
                <div id="motivational_speech_area">
                    <div id="blank_motivational_speech_field">
                        <div class="d-flex mt-2 border-top pt-2">
                            <div class="flex-grow-1 px-2 mb-3">
                                <div class="fpb-7 mb-3">
                                    <label class="form-label ol-form-label">{{ get_phrase('Title') }}</label>
                                    <input type="text" class="form-control ol-form-control" name="title" value="{{ $kindergarden->title ?? '' }}" placeholder="Enter a title" required>
                                </div>
                                <div class="fpb-7 mb-3">
                                    <label class="form-label ol-form-label">{{ get_phrase('Description') }}</label>
                                    <textarea name="description" class="form-control ol-form-control" placeholder="{{ get_phrase('Description') }}" required>{{ $kindergarden->description ?? '' }}</textarea>
                                </div>
                                <div class="fpb-7 mb-3">
                                    <label class="form-label ol-form-label">{{ get_phrase('Image') }}</label>
                                    <div class="custom-file">
                                        <input name="previous_image" type="hidden" value="{{ $kindergarden->image ?? '' }}">
                                        <input type="file" class="form-control ol-form-control" name="image" value="{{ $kindergarden->image ?? '' }}" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fpb-7 mb-2 flex-grow-1 px-2">
                    <button type="submit" class="btn ol-btn-primary">{{ get_phrase('Save changes') }}</button>
                </div>
            </div>
        </div>
    @elseif($home_page_identifire == 'marketplace')
        <h5 class="title mt-4 mb-3">{{ get_phrase('Become An Instructor') }}</h5>
        <div class="row">
            <div class="col-md-12">
                @php
                    $settings = get_homepage_settings('marketplace');
                    $marketplace = json_decode($settings);
                    if ($marketplace && isset($marketplace->instructor)) {
                        $instructor = $marketplace->instructor;
                    }
                @endphp
                <div id="motivational_speech_area">
                    <div id="blank_motivational_speech_field">
                        <div class="d-flex mt-2 border-top pt-2">
                            <div class="flex-grow-1 px-2 mb-3">
                                <div class="fpb-7 mb-3">
                                    <label class="form-label ol-form-label">{{ get_phrase('Title') }}</label>
                                    <input type="text" class="form-control ol-form-control" name="title" value="{{ $instructor->title ?? '' }}" placeholder="Enter a title" required>
                                </div>
                                <div class="fpb-7 mb-3">
                                    <label class="form-label ol-form-label">{{ get_phrase('Description') }}</label>
                                    <textarea name="description" class="form-control ol-form-control" placeholder="{{ get_phrase('Description') }}" required>{{ $instructor->description ?? '' }}</textarea>
                                </div>
                                <div class="fpb-7 mb-3">
                                    <label class="form-label ol-form-label">{{ get_phrase('Video Url') }}</label>
                                    <input type="text" class="form-control ol-form-control" name="video_url" value="{{ $instructor->video_url ?? '' }}" placeholder="enter a video url" required>
                                </div>
                                <div class="fpb-7 mb-3">
                                    <label class="form-label ol-form-label">{{ get_phrase('Image') }}</label>
                                    <div class="custom-file">
                                        <input name="previous_image" type="hidden" value="{{ $instructor->image ?? '' }}">
                                        <input type="file" class="form-control ol-form-control" name="image" value="{{ $instructor->image ?? '' }}" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <h5 class="title mt-4 mb-3">{{ get_phrase('Banner Information') }}</h5>
            <div class="col-md-12">
                <div id = "motivational_speech_areas">
                    @php
                        $settings = get_homepage_settings('marketplace');
                        if (!$settings) {
                            $settings = '{"slider":[{"banner_title":"","banner_description":""}]}';
                        }
                        $marketplace = json_decode($settings);
                        $sliders = [];
                        $maxKey = 0;
                        if ($marketplace && isset($marketplace->slider)) {
                            $sliders = $marketplace->slider;
                            $maxKey = count($sliders) > 0 ? max(array_keys((array) $sliders)) : 0;
                        }
                    @endphp
                    @foreach ($sliders as $key => $slider)
                        <div class="d-flex mt-2">
                            <input type="hidden" name="slider[]" value="{{ $key }}">
                            <div class="flex-grow-1 px-2 mb-3">
                                <div class="fpb-7 mb-3">
                                    <label class="form-label ol-form-label">{{ get_phrase('Title') }}</label>
                                    <input type="text" class="form-control ol-form-control" name="banner_title{{ $key }}" placeholder="{{ get_phrase('Title') }}" value="{{ $slider?->banner_title }}">
                                </div>
                                <div class="fpb-7 mb-3">
                                    <label class="form-label ol-form-label">{{ get_phrase('Description') }}</label>
                                    <textarea name="banner_description{{ $key }}" class="form-control ol-form-control" placeholder="{{ get_phrase('Description') }}">{{ $slider?->banner_description }}</textarea>
                                </div>

                            </div>

                            @if ($key == 0)
                                <div class="pt-4">
                                    <button type="button" class="btn ol-btn-light ol-icon-btn mt-2" name="button" data-bs-toggle="tooltip" title="{{ get_phrase('Add new') }}" onclick="appendMotivational_speech()"> <i class="fi-rr-plus-small"></i>
                                    </button>
                                </div>
                            @else
                                <div class="pt-4">
                                    <button type="button" class="btn ol-btn-light ol-icon-btn mt-2" name="button" data-bs-toggle="tooltip" title="{{ get_phrase('Remove') }}" onclick="removeMotivational_speech(this)">
                                        <i class="fi-rr-minus-small"></i> </button>
                                </div>
                            @endif
                        </div>
                    @endforeach
                    <div id = "blank_motivational_speech_fields">
                        <div class="d-flex mt-2 border-top pt-2">
                            <div class="flex-grow-1 px-2 mb-3">
                                <div class="fpb-7 mb-3">
                                    <label class="form-label ol-form-label">{{ get_phrase('Title') }}</label>
                                    <input type="text" class="form-control ol-form-control" name="banner_title" placeholder="{{ get_phrase('Title') }}">
                                </div>
                                <div class="fpb-7 mb-3">
                                    <label class="form-label ol-form-label">{{ get_phrase('Description') }}</label>
                                    <textarea name="banner_description" class="form-control ol-form-control" placeholder="{{ get_phrase('Description') }}"></textarea>
                                </div>
                            </div>
                            <div class="pt-4">
                                <button type="button" class="btn ol-btn-light ol-icon-btn mt-2" name="button" data-bs-toggle="tooltip" title="{{ get_phrase('Remove') }}" onclick="removeMotivational_speech(this)">
                                    <i class="fi-rr-minus-small"></i> </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="fpb-7 mb-2 flex-grow-1 px-2">
            <button type="submit" class="btn ol-btn-primary">{{ get_phrase('Save changes') }}</button>
        </div>
        <script type="text/javascript">
            "use strict";

            let blank_motivational_speech = jQuery('#blank_motivational_speech_fields').html();
            let sliderCounter = {{ $maxKey + 1 }};
            $(document).ready(function() {
                jQuery('#blank_motivational_speech_fields').hide();
            });

            function appendMotivational_speech() {
                let newMotivationalSpeech = jQuery('#blank_motivational_speech_fields').clone();
                newMotivationalSpeech.find('input[name="banner_title"]').attr('name', 'banner_title' + sliderCounter);
                newMotivationalSpeech.find('textarea[name="banner_description"]').attr('name', 'banner_description' + sliderCounter);
                jQuery('#motivational_speech_areas').append(newMotivationalSpeech.html());
                let newHiddenInput = '<input type="hidden" name="slider[]" value="' + sliderCounter + '">';
                jQuery('#motivational_speech_areas').append(newHiddenInput);
                sliderCounter++;
            }

            function removeMotivational_speech(faqElem) {
                jQuery(faqElem).parent().parent().remove();
                sliderCounter--;
            }
        </script>
    @elseif($home_page_identifire == 'meditation')
        @php
            $bigImage = json_decode(get_homepage_settings('meditation'));
        @endphp
        <div class="row">
            <h5 class="title mt-4 mb-3">{{ get_phrase('Meditation Big  Image') }}</h5>
            <div id="speech_area">
                <div id="blank_motivational">
                    <div class="d-flex mt-2 border-top pt-2">
                        <div class="flex-grow-1 px-2 mb-3">
                            <div class="fpb-7 mb-3">
                                <label class="form-label ol-form-label">{{ get_phrase('Big Image') }}</label>
                                <div class="custom-file">
                                    <input type="hidden" class="form-control ol-form-control" name="big_previous_image" value="{{ $bigImage->big_image ?? '' }}">
                                    <input type="file" class="form-control ol-form-control" name="big_image" value="{{ $bigImage->big_image ?? '' }}" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h5 class="title mt-4 mb-3">{{ get_phrase('Meditation Featured') }}</h5>
            <div class="col-md-12">
                <div id = "area">
                    @php
                        $settings = get_homepage_settings('meditation');
                        if (!$settings) {
                            $settings = '{"meditation":[{"banner_title":"","banner_description":"", "image":""}]}';
                        }
                        $meditation_text = json_decode($settings);
                        $meditations = [];
                        $maxkey = 0;
                        if ($meditation_text && isset($meditation_text->meditation)) {
                            $meditations = $meditation_text->meditation;
                            $maxkey = count($meditations) > 0 ? max(array_keys((array) $meditations)) : 0;
                        }
                    @endphp
                    @foreach ($meditations as $key => $slider)
                        <div class="d-flex mt-2">
                            <input type="hidden" name="meditation[]" value="{{ $key }}">
                            <div class="flex-grow-1 px-2 mb-3">
                                <div class="fpb-7 mb-3">
                                    <label class="form-label ol-form-label">{{ get_phrase('Title') }}</label>
                                    <input type="text" class="form-control ol-form-control" name="banner_title{{ $key }}" placeholder="{{ get_phrase('Title') }}" value="{{ $slider->banner_title }}" required>
                                </div>
                                <div class="fpb-7 mb-3">
                                    <label class="form-label ol-form-label">{{ get_phrase('Description') }}</label>
                                    <textarea name="banner_description{{ $key }}" class="form-control ol-form-control" placeholder="{{ get_phrase('Description') }}" required>{{ $slider->banner_description }}</textarea>
                                </div>
                                <div class="fpb-7 mb-3">
                                    <label class="form-label ol-form-label">{{ get_phrase('Image') }}</label>
                                    <div class="custom-file">
                                        <input type="hidden" name="old_image{{ $key }}" value="{{ $slider->image ?? '' }}">
                                        <input type="file" class="form-control ol-form-control" name="image{{ $key }}" value="{{ $slider->image ?? '' }}" accept="image/*">
                                    </div>
                                </div>

                            </div>

                            @if ($key == 0)
                                <div class="pt-4">
                                    <button type="button" class="btn ol-btn-light ol-icon-btn mt-2" name="button" data-bs-toggle="tooltip" title="{{ get_phrase('Add new') }}" onclick="append_speech()"> <i class="fi-rr-plus-small"></i>
                                    </button>
                                </div>
                            @else
                                <div class="pt-4">
                                    <button type="button" class="btn ol-btn-light ol-icon-btn mt-2" name="button" data-bs-toggle="tooltip" title="{{ get_phrase('Remove') }}" onclick="remove_speech(this)">
                                        <i class="fi-rr-minus-small"></i> </button>
                                </div>
                            @endif
                        </div>
                    @endforeach
                    <div id = "blank_fields">
                        <div class="d-flex mt-2 border-top pt-2 w-100">
                            <div class="flex-grow-1 px-2 mb-3">
                                <div class="fpb-7 mb-3">
                                    <label class="form-label ol-form-label">{{ get_phrase('Title') }}</label>
                                    <input type="text" class="form-control ol-form-control" name="banner_title" placeholder="{{ get_phrase('Title') }}">
                                </div>
                                <div class="fpb-7 mb-3">
                                    <label class="form-label ol-form-label">{{ get_phrase('Description') }}</label>
                                    <textarea name="banner_description" class="form-control ol-form-control" placeholder="{{ get_phrase('Description') }}"></textarea>
                                </div>
                                <div class="fpb-7 mb-3">
                                    <label class="form-label ol-form-label">{{ get_phrase('Image') }}</label>
                                    <div class="custom-file">
                                        <input type="hidden" class="form-control ol-form-control" name="old_image" value="">
                                        <input type="file" class="form-control ol-form-control" name="image" value="" accept="image/*">
                                    </div>
                                </div>
                            </div>
                            <div class="pt-4">
                                <button type="button" class="btn ol-btn-light ol-icon-btn mt-2" name="button" data-bs-toggle="tooltip" title="{{ get_phrase('Remove') }}" onclick="remove_speech(this)">
                                    <i class="fi-rr-minus-small"></i> </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="fpb-7 mb-2 flex-grow-1 px-2">
                <button type="submit" class="btn ol-btn-primary">{{ get_phrase('Save changes') }}</button>
            </div>
        </div>
        <script type="text/javascript">
            "use strict";

            let blank_motivational_speech = jQuery('#blank_fields').html();
            let sliderCounter = {{ $maxkey + 1 }};
            $(document).ready(function() {
                jQuery('#blank_fields').hide();
            });

            function append_speech() {
                let newMotivationalSpeech = jQuery('#blank_fields').clone();
                newMotivationalSpeech.find('input[name="banner_title"]').attr('name', 'banner_title' + sliderCounter);
                newMotivationalSpeech.find('input[name="image"]').attr('name', 'image' + sliderCounter);
                newMotivationalSpeech.find('input[name="old_image"]').attr('name', 'old_image' + sliderCounter);
                newMotivationalSpeech.find('textarea[name="banner_description"]').attr('name', 'banner_description' + sliderCounter);
                jQuery('#area').append(newMotivationalSpeech.html());
                let newHiddenInput = '<input type="hidden" name="meditation[]" value="' + sliderCounter + '">';
                jQuery('#area').append(newHiddenInput);
                sliderCounter++;
            }

            function remove_speech(faqElem) {
                jQuery(faqElem).parent().parent().remove();
                sliderCounter--;
            }
        </script>
    @elseif($home_page_identifire == 'landingpage')
        @php
            $landingpage_settings = json_decode(get_homepage_settings('landingpage'));
            if (!$landingpage_settings) {
                $landingpage_settings = (object) [];
            }
            $about_features = $landingpage_settings->about_features ?? ['', '', ''];
            $what_features = $landingpage_settings->what_features ?? ['', '', ''];
            $why_features = $landingpage_settings->why_features ?? ['', '', ''];
        @endphp

        <!-- Hero Section -->
        <h5 class="title mt-4 mb-3">{{ get_phrase('Hero Section') }}</h5>
        <div class="row">
            <div class="col-md-12">
                <div class="fpb-7 mb-3">
                    <label class="form-label ol-form-label">{{ get_phrase('Hero Title') }}</label>
                    <input type="text" class="form-control ol-form-control" name="hero_title"
                        value="{{ $landingpage_settings->hero_title ?? '' }}" placeholder="Enter hero title" required>
                </div>

                <div class="fpb-7 mb-3">
                    <label class="form-label ol-form-label">{{ get_phrase('Hero Subtitle') }}</label>
                    <input type="text" class="form-control ol-form-control" name="hero_subtitle"
                        value="{{ $landingpage_settings->hero_subtitle ?? '' }}" placeholder="Enter hero subtitle" required>
                </div>

                <div class="fpb-7 mb-3">
                    <label class="form-label ol-form-label">{{ get_phrase('Hero Description') }}</label>
                    <textarea name="hero_description" class="form-control ol-form-control" rows="4"
                        placeholder="{{ get_phrase('Enter hero description') }}" required>{{ $landingpage_settings->hero_description ?? '' }}</textarea>
                    <small class="form-text text-muted">{{ get_phrase('Use Enter/Return key for new lines') }}</small>
                </div>

                <div class="fpb-7 mb-3">
                    <label class="form-label ol-form-label">{{ get_phrase('Hero Image') }}</label>
                    <input name="previous_hero_image" type="hidden" value="{{ $landingpage_settings->hero_image ?? '' }}">
                    <input type="file" class="form-control ol-form-control" name="hero_image" accept="image/*">
                    @if(isset($landingpage_settings->hero_image))
                        <div class="mt-2">
                            <img src="{{ asset($landingpage_settings->hero_image) }}" alt="Hero Image" style="max-width: 200px;" class="img-thumbnail">
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Spotlight Logos -->
        <h5 class="title mt-4 mb-3 border-top pt-3">{{ get_phrase('Spotlight Logos') }}</h5>
        <div class="row">
            @for($i = 1; $i <= 4; $i++)
                @php
                    $logo_field = 'spotlight_logo_' . $i;
                    $alt_field = 'spotlight_logo_' . $i . '_alt';
                @endphp
                <div class="col-md-6 mb-3">
                    <div class="fpb-7 mb-2">
                        <label class="form-label ol-form-label">{{ get_phrase('Logo') }} {{ $i }} {{ get_phrase('Alt Text') }}</label>
                        <input type="text" class="form-control ol-form-control" name="{{ $alt_field }}"
                            value="{{ $landingpage_settings->$alt_field ?? '' }}" placeholder="e.g., Tribunnews">
                    </div>
                    <div class="fpb-7 mb-2">
                        <label class="form-label ol-form-label">{{ get_phrase('Logo') }} {{ $i }} {{ get_phrase('Image') }}</label>
                        <input name="previous_{{ $logo_field }}" type="hidden" value="{{ $landingpage_settings->$logo_field ?? '' }}">
                        <input type="file" class="form-control ol-form-control" name="{{ $logo_field }}" accept="image/*">
                        @if(isset($landingpage_settings->$logo_field))
                            <div class="mt-2">
                                <img src="{{ asset($landingpage_settings->$logo_field) }}" alt="Logo {{ $i }}" style="max-width: 100px;" class="img-thumbnail">
                            </div>
                        @endif
                    </div>
                </div>
            @endfor
        </div>

        <!-- About AI Section -->
        <h5 class="title mt-4 mb-3 border-top pt-3">{{ get_phrase('About AI Section') }}</h5>
        <div class="row">
            <div class="col-md-12">
                <div class="fpb-7 mb-3">
                    <label class="form-label ol-form-label">{{ get_phrase('Section Title') }}</label>
                    <input type="text" class="form-control ol-form-control" name="about_title"
                        value="{{ $landingpage_settings->about_title ?? '' }}" placeholder="Enter section title" required>
                </div>

                <div class="fpb-7 mb-3">
                    <label class="form-label ol-form-label">{{ get_phrase('Introduction Text') }}</label>
                    <textarea name="about_intro" class="form-control ol-form-control" rows="2"
                        placeholder="{{ get_phrase('Enter introduction') }}" required>{{ $landingpage_settings->about_intro ?? '' }}</textarea>
                </div>

                <div class="fpb-7 mb-3">
                    <label class="form-label ol-form-label">{{ get_phrase('List Title') }}</label>
                    <input type="text" class="form-control ol-form-control" name="about_list_title"
                        value="{{ $landingpage_settings->about_list_title ?? '' }}" placeholder="e.g., Tapi hanya sedikit yang:">
                </div>

                <div class="fpb-7 mb-3">
                    <label class="form-label ol-form-label">{{ get_phrase('Feature Points') }}</label>
                    @foreach($about_features as $index => $feature)
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fi-rr-check"></i></span>
                            <input type="text" class="form-control" name="about_features[]" value="{{ $feature }}" placeholder="Feature {{ $index + 1 }}">
                        </div>
                    @endforeach
                </div>

                <div class="fpb-7 mb-3">
                    <label class="form-label ol-form-label">{{ get_phrase('Closing Text') }}</label>
                    <textarea name="about_closing" class="form-control ol-form-control" rows="2"
                        placeholder="{{ get_phrase('Enter closing text') }}">{{ $landingpage_settings->about_closing ?? '' }}</textarea>
                </div>
            </div>
        </div>

        <!-- What Section -->
        <h5 class="title mt-4 mb-3 border-top pt-3">{{ get_phrase('What is 1001 AI Pioneers Section') }}</h5>
        <div class="row">
            <div class="col-md-12">
                <div class="fpb-7 mb-3">
                    <label class="form-label ol-form-label">{{ get_phrase('Section Title') }}</label>
                    <input type="text" class="form-control ol-form-control" name="what_title"
                        value="{{ $landingpage_settings->what_title ?? '' }}" placeholder="Enter section title" required>
                </div>

                <div class="fpb-7 mb-3">
                    <label class="form-label ol-form-label">{{ get_phrase('Introduction Text') }}</label>
                    <textarea name="what_intro" class="form-control ol-form-control" rows="2"
                        placeholder="{{ get_phrase('Enter introduction') }}" required>{{ $landingpage_settings->what_intro ?? '' }}</textarea>
                </div>

                <div class="fpb-7 mb-3">
                    <label class="form-label ol-form-label">{{ get_phrase('List Title') }}</label>
                    <input type="text" class="form-control ol-form-control" name="what_list_title"
                        value="{{ $landingpage_settings->what_list_title ?? '' }}" placeholder="e.g., Tapi untuk:">
                </div>

                <div class="fpb-7 mb-3">
                    <label class="form-label ol-form-label">{{ get_phrase('Feature Points') }}</label>
                    @foreach($what_features as $index => $feature)
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fi-rr-check"></i></span>
                            <input type="text" class="form-control" name="what_features[]" value="{{ $feature }}" placeholder="Feature {{ $index + 1 }}">
                        </div>
                    @endforeach
                </div>

                <div class="fpb-7 mb-3">
                    <label class="form-label ol-form-label">{{ get_phrase('Closing Text') }}</label>
                    <textarea name="what_closing" class="form-control ol-form-control" rows="2"
                        placeholder="{{ get_phrase('Enter closing text') }}">{{ $landingpage_settings->what_closing ?? '' }}</textarea>
                </div>
            </div>
        </div>

        <!-- Why Different Section -->
        <h5 class="title mt-4 mb-3 border-top pt-3">{{ get_phrase('Why Different Section') }}</h5>
        <div class="row">
            <div class="col-md-12">
                <div class="fpb-7 mb-3">
                    <label class="form-label ol-form-label">{{ get_phrase('Section Title') }}</label>
                    <input type="text" class="form-control ol-form-control" name="why_title"
                        value="{{ $landingpage_settings->why_title ?? '' }}" placeholder="Enter section title" required>
                </div>

                <div class="fpb-7 mb-3">
                    <label class="form-label ol-form-label">{{ get_phrase('List Title') }}</label>
                    <input type="text" class="form-control ol-form-control" name="why_list_title"
                        value="{{ $landingpage_settings->why_list_title ?? '' }}" placeholder="e.g., Karena:">
                </div>

                <div class="fpb-7 mb-3">
                    <label class="form-label ol-form-label">{{ get_phrase('Feature Points') }}</label>
                    @foreach($why_features as $index => $feature)
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fi-rr-check"></i></span>
                            <input type="text" class="form-control" name="why_features[]" value="{{ $feature }}" placeholder="Feature {{ $index + 1 }}">
                        </div>
                    @endforeach
                </div>

                <div class="fpb-7 mb-3">
                    <label class="form-label ol-form-label">{{ get_phrase('Closing Text') }}</label>
                    <textarea name="why_closing" class="form-control ol-form-control" rows="2"
                        placeholder="{{ get_phrase('Enter closing text') }}">{{ $landingpage_settings->why_closing ?? '' }}</textarea>
                </div>
            </div>
        </div>

        <!-- Access/Pricing Section -->
        <h5 class="title mt-4 mb-3 border-top pt-3">{{ get_phrase('Access & Pricing Section') }}</h5>
        <div class="row">
            <div class="col-md-12">
                <div class="fpb-7 mb-3">
                    <label class="form-label ol-form-label">{{ get_phrase('Section Title') }}</label>
                    <input type="text" class="form-control ol-form-control" name="access_title"
                        value="{{ $landingpage_settings->access_title ?? '' }}" placeholder="e.g., Akses">
                </div>

                <div class="fpb-7 mb-3">
                    <label class="form-label ol-form-label">{{ get_phrase('Section Subtitle') }}</label>
                    <input type="text" class="form-control ol-form-control" name="access_subtitle"
                        value="{{ $landingpage_settings->access_subtitle ?? '' }}" placeholder="e.g., Program ini berjalan dengan sistem...">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="fpb-7 mb-3">
                            <label class="form-label ol-form-label">{{ get_phrase('Pricing') }}</label>
                            <input type="text" class="form-control ol-form-control" name="pricing"
                                value="{{ $landingpage_settings->pricing ?? '' }}" placeholder="e.g., Rp 199.000" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="fpb-7 mb-3">
                            <label class="form-label ol-form-label">{{ get_phrase('Pricing Period') }}</label>
                            <input type="text" class="form-control ol-form-control" name="pricing_period"
                                value="{{ $landingpage_settings->pricing_period ?? '' }}" placeholder="e.g., Per bulan" required>
                        </div>
                    </div>
                </div>

                <div class="fpb-7 mb-3">
                    <label class="form-label ol-form-label">{{ get_phrase('Pricing Note') }}</label>
                    <textarea name="pricing_note" class="form-control ol-form-control" rows="2"
                        placeholder="{{ get_phrase('Additional pricing information') }}">{{ $landingpage_settings->pricing_note ?? '' }}</textarea>
                </div>

                <div class="fpb-7 mb-3">
                    <label class="form-label ol-form-label">{{ get_phrase('Disclaimer Text') }}</label>
                    <input type="text" class="form-control ol-form-control" name="pricing_disclaimer"
                        value="{{ $landingpage_settings->pricing_disclaimer ?? '' }}" placeholder="e.g., *Halaman ini tidak selalu tersedia...">
                </div>
            </div>
        </div>

        <!-- CTA Button -->
        <h5 class="title mt-4 mb-3 border-top pt-3">{{ get_phrase('Call-to-Action Button') }}</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="fpb-7 mb-3">
                    <label class="form-label ol-form-label">{{ get_phrase('Button Text') }}</label>
                    <input type="text" class="form-control ol-form-control" name="cta_button_text"
                        value="{{ $landingpage_settings->cta_button_text ?? '' }}" placeholder="e.g., Masuk Ke 1001 Ai Pioneer" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="fpb-7 mb-3">
                    <label class="form-label ol-form-label">{{ get_phrase('Button Link') }}</label>
                    <input type="text" class="form-control ol-form-control" name="cta_button_link"
                        value="{{ $landingpage_settings->cta_button_link ?? '' }}" placeholder="e.g., /courses or https://..." required>
                    <small class="form-text text-muted">{{ get_phrase('Use relative path (/courses) or full URL') }}</small>
                </div>
            </div>
        </div>

        <!-- Section Visibility -->
        <h5 class="title mt-4 mb-3 border-top pt-3">{{ get_phrase('Section Visibility') }}</h5>
        <div class="row">
            <div class="col-md-12">
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="show_spotlight" id="show_spotlight" 
                        {{ ($landingpage_settings->show_spotlight ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="show_spotlight">{{ get_phrase('Show Spotlight Section') }}</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="show_about" id="show_about"
                        {{ ($landingpage_settings->show_about ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="show_about">{{ get_phrase('Show About AI Section') }}</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="show_what" id="show_what"
                        {{ ($landingpage_settings->show_what ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="show_what">{{ get_phrase('Show What Section') }}</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="show_why" id="show_why"
                        {{ ($landingpage_settings->show_why ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="show_why">{{ get_phrase('Show Why Different Section') }}</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="show_pricing" id="show_pricing"
                        {{ ($landingpage_settings->show_pricing ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="show_pricing">{{ get_phrase('Show Pricing Section') }}</label>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="fpb-7 mb-3 mt-4">
            <button type="submit" class="btn ol-btn-primary">{{ get_phrase('Save Changes') }}</button>
        </div>

    @else
        <div class="alert alert-warning mt-4">
            <h5>{{ get_phrase('Template Not Supported') }}</h5>
            <p>{{ get_phrase('This page template does not have editable home page settings') }}.</p>
            <p><strong>{{ get_phrase('Template') }}:</strong> {{ $home_page_identifire }}</p>
        </div>
    @endif
</form>
