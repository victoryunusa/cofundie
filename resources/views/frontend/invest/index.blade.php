@extends('layouts.frontend.app')

@section('content')
    <!-- Breadcrumb Area Start -->
    <section class="breadcrumb-area py-36  bg-img" style="background-image:url({{ asset('frontend/img/bg-img/5.png') }})">
        <div class="breadcrumb-content-text h-100 flex items-center">
            <div class="container ">
                <div class="grid grid-cols-12 gap-4 items-center">
                    <div class="breadcrumb-text mt-28 col-span-12 text-center">
                        @if(isset($data['headings']['heading.investments']))
                            @php
                            $heading = $data['headings']['heading.investments'];
                            @endphp
                            <h4 class="text-5xl mb-3 font-extrabold capitalize">{{ $heading['title'] ?? null }}</h4>
                            <p class="text-lg max-w-xl mx-auto">{{ $heading['description'] ?? null }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Area End -->

    @if(isset($data['headings']['heading.investments']))
        @php
        $heading = $data['headings']['heading.investments'];
        @endphp
        <!-- Investment Card -->
        <div class="investment-card-area section-padding-100-50">
            <div class="container">
                <div class="grid grid-cols-12 md:gap-10">
                    <div class="col-span-12 md:col-span-6 lg:col-span-4">
                        <div class="single-invest-card bg-gray-100 py-12 px-10 rounded-lg text-center mb-50">
                            <div class="invest-icon mb-4">
                                <svg version="1.1" viewBox="0 0 65 63" class="svg-icon svg-fill"
                                    style="width: 64px; height: auto; margin: auto;">
                                    <defs>
                                        <pattern id="svgicon_text-bubble_b" width="4.973" height="4.973" x="-4.973"
                                            y="-4.973" patternUnits="userSpaceOnUse">
                                            <use xlink:href="#svgicon_text-bubble_a" transform="scale(.49732)"></use>
                                        </pattern>
                                        <image id="svgicon_text-bubble_a" width="10" height="10"
                                            xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAABGdBTUEAALGOfPtRkwAAAYNpQ0NQSUNDIFByb2ZpbGUAACiRlZE9SMNQFIVPKlKU+jOIiFNA6VSlVBAFEdoMInSopYOKDvlrWqhJSGNVdBR0LDiILopdHJx1LbjqpCiCODm4F120xPuSaiqi4oFwv9x337vvngcEjkXTLAS6gSXdttJTCX52bp4PPqIN7XAlykUznkolGX/Er3q5Acfi1RA76/v6rwopalEGuB5iWzYtm3ibeGDFNhmfEPdYdCniKmPN42vGksdPbk0mLRC/EXeWZI32BkLEUV3J68QTxJNyTlSIN4gjUlO91sTefVz1C2IhL1mirSo8s0YwCoZVNEVZ/eeQf8lWV20WBcNcs/Jazubj5KTKT+vycISPRWNRgL2LV12bcf3mei/8nHEIjD0DLWU/J+0CZ1tA352fGzwAujaB03N52So12nOg7p5njX/uk/ATe766GgUqt0BmHUheAnv7QDhLfRaAVAflx2nCRf/zVMyOxLyzQgmg9cFxamEguAPUy47zeuQ49QrNcw9U9XcUym+KdBRqyQAAADhlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAAqACAAQAAAABAAAACqADAAQAAAABAAAACgAAAAAYsJrPAAAAFUlEQVQYGWNgIA78J0bZqCIG6gUBAO0QCfcp73TaAAAAAElFTkSuQmCC">
                                        </image>
                                    </defs>
                                    <g fill-rule="nonzero" fill="none">
                                        <path pid="0" fill="#FEFEFE" d="M0 0v45.44h14.221v13.956L32.35 45.44H65V0z"></path>
                                        <path pid="1" fill="#909294"
                                            d="M0 48.905h14.221v-3.468H0zM32.35 45.439L14.22 59.397v3.466L32.35 48.907H65v-3.468z">
                                        </path>
                                        <path pid="2" fill-opacity=".4" fill="url(#svgicon_text-bubble_b)"
                                            d="M32.934 0v45.44h-.585L14.222 59.395V45.44H0V0z"></path>
                                        <path pid="3" fill="#22262A"
                                            d="M10.34 12.714h44.318v-1.407H10.34zM10.34 23.642h44.318v-1.407H10.34zM10.34 34.572h44.318v-1.407H10.34z">
                                        </path>
                                        <path pid="4" d="M24.005 12.01a3.166 3.166 0 11-6.331.001 3.166 3.166 0 016.33 0"
                                            fill="#F4633A"></path>
                                        <path pid="5"
                                            d="M20.839 7.79a4.225 4.225 0 00-4.221 4.22 4.226 4.226 0 004.22 4.222 4.226 4.226 0 004.222-4.222 4.225 4.225 0 00-4.221-4.22m0 1.054a3.166 3.166 0 11-.001 6.333 3.166 3.166 0 010-6.333"
                                            fill="#FEFEFE"></path>
                                        <path pid="6" d="M44.682 19.774a3.166 3.166 0 110 6.332 3.167 3.167 0 110-6.332"
                                            fill="#F4633A"></path>
                                        <path pid="7"
                                            d="M44.682 18.718a4.227 4.227 0 00-4.222 4.222 4.226 4.226 0 004.222 4.22 4.226 4.226 0 004.221-4.22 4.226 4.226 0 00-4.22-4.222m0 1.056a3.166 3.166 0 110 6.332 3.167 3.167 0 110-6.332"
                                            fill="#FEFEFE"></path>
                                        <path pid="8" d="M29.686 30.702a3.166 3.166 0 110 6.331 3.166 3.166 0 010-6.33"
                                            fill="#F4633A"></path>
                                        <path pid="9"
                                            d="M29.686 29.647a4.225 4.225 0 00-4.221 4.22 4.225 4.225 0 004.22 4.222 4.225 4.225 0 004.222-4.221 4.225 4.225 0 00-4.221-4.221m0 1.055a3.166 3.166 0 110 6.333 3.166 3.166 0 010-6.333"
                                            fill="#FEFEFE"></path>
                                    </g>
                                </svg>
                            </div>
                            <p>{{ $heading['feature_1'] ?? null }}</p>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-4">
                        <div class="single-invest-card bg-gray-100 py-12 px-10 rounded-lg text-center mb-50">
                            <div class="invest-icon mb-4">
                                <svg version="1.1" viewBox="0 0 63 68" class="svg-icon svg-fill"
                                    style="width: 64px; height: auto; margin: auto;">
                                    <defs>
                                        <pattern id="svgicon_target_d" width="5.037" height="5.037" x="-5.037" y="-2.676"
                                            patternUnits="userSpaceOnUse">
                                            <use xlink:href="#svgicon_target_a" transform="scale(.50373)"></use>
                                        </pattern>
                                        <image id="svgicon_target_a" width="10" height="10"
                                            xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAABGdBTUEAALGPC/xhBQAAAYNpQ0NQSUNDIFByb2ZpbGUAACiRlZG9S8NQFMVPKtKlfgxFRBwCSqcqtYIoiNBmEKFDLR1UdMhX00JNQhqroqOCY8GpTtIuDs669g9QHBQFETfBveiiJd6XVKOIigfC/eW++9599zwgcCSaZjHQC6zqtpWZTfILi0t88AFBDMKVKJfMRDqdYvwev+r5GhyLlyPsrO/rvyqkqCUZ4MLEtmxaNvEe8dC6bTI+Jg5bdCniBmPN4yvGksePbk02IxC/EneXZY32BkLEMV0p6MTTxDNyXlSIt4mj0qd67RN793E1IIjFgmSJtqrwzBrBKBpWyRRl9Z9D/iVb3bBZFAxz0ypoeZtPkJMqP6fLo1E+HouPAexdvOrmvOs313fm54waMPkEdFT8nFQFTneB/ls/N3wI9OwAJxfymlVut+dA3T3P2v/cB+En9nx1NQHUb4DsFpA6B6oHQCRHfZaBdBflp2jCFf/zVMqNx72zQkmg895xmhEguA+0Ko7zUnOcVp3muQMa+htMWG+s/tELzgAAADhlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAAqACAAQAAAABAAAACqADAAQAAAABAAAACgAAAAAYsJrPAAAAFUlEQVQYGWNgIA78J0bZqCIG6gUBAO0QCfcp73TaAAAAAElFTkSuQmCC">
                                        </image>
                                        <path pid="0" id="svgicon_target_b" d="M0 0h4.654v8.43H0z"></path>
                                    </defs>
                                    <g fill="none" fill-rule="evenodd">
                                        <path pid="1"
                                            d="M30.12 46.317c-7.812 0-14.167-6.357-14.167-14.168 0-7.81 6.355-14.165 14.167-14.165 7.81 0 14.166 6.355 14.166 14.165 0 7.811-6.355 14.168-14.166 14.168m0-35.526c-11.957 0-21.684 9.729-21.684 21.685s9.727 21.682 21.684 21.682c11.955 0 21.683-9.726 21.683-21.682 0-11.956-9.728-21.685-21.683-21.685"
                                            fill="#F4F4F4"></path>
                                        <path pid="2"
                                            d="M30.12 54.77c-12.294 0-22.296-10-22.296-22.294 0-12.295 10.002-22.296 22.296-22.296 12.293 0 22.295 10 22.295 22.296 0 12.294-10.002 22.295-22.295 22.295m-.001-52.415C13.485 2.356 0 15.841 0 32.475s13.485 30.12 30.119 30.12 30.12-13.486 30.12-30.12S46.753 2.356 30.119 2.356"
                                            fill="#FFF"></path>
                                        <path pid="3" fill="#AEAEAE" d="M58.693 3.901L54.165 8.43l3.9.126 4.529-4.53z">
                                        </path>
                                        <g transform="translate(54.039)">
                                            <mask id="svgicon_target_c" fill="#fff">
                                                <use xlink:href="#svgicon_target_b"></use>
                                            </mask>
                                            <path pid="4" fill="#F4F4F4" mask="url(#svgicon_target_c)"
                                                d="M4.529 0L0 4.53l.125 3.9L4.655 3.9z"></path>
                                        </g>
                                        <path pid="5"
                                            d="M12.506 56.9l-2.37 4.249a30.148 30.148 0 004.292 2.64l2.356-4.307a30.17 30.17 0 01-4.278-2.582M43.454 59.482l2.357 4.307a30.242 30.242 0 004.291-2.64l-2.37-4.25a30.004 30.004 0 01-4.278 2.583"
                                            fill="#C34F2E"></path>
                                        <path pid="6"
                                            d="M13.901 57.843c-.123-.078-.248-.154-.37-.234.122.08.247.156.37.234M14.65 58.313c-.02-.013-.042-.024-.063-.036l.063.036"
                                            fill="#F1633A"></path>
                                        <path pid="7"
                                            d="M30.12 10.791c-11.957 0-21.684 9.729-21.684 21.685 0 11.955 9.727 21.682 21.684 21.682 11.955 0 21.683-9.727 21.683-21.682 0-11.956-9.728-21.685-21.683-21.685m0 43.98c-12.294 0-22.296-10-22.296-22.295 0-12.295 10.002-22.296 22.296-22.296 12.293 0 22.295 10.001 22.295 22.296 0 12.294-10.002 22.296-22.295 22.296"
                                            fill="#020303"></path>
                                        <path pid="8"
                                            d="M15.953 32.15c0-7.746 6.248-14.056 13.97-14.163V2.361C13.38 2.467 0 15.907 0 32.474c0 16.57 13.38 30.008 29.923 30.114V46.311c-7.722-.105-13.97-6.416-13.97-14.161"
                                            fill-opacity=".4" fill="url(#svgicon_target_d)"></path>
                                        <path pid="9"
                                            d="M30.119 37.88a5.738 5.738 0 01-5.731-5.73c0-3.16 2.572-5.73 5.73-5.73 3.16 0 5.733 2.57 5.733 5.73a5.738 5.738 0 01-5.732 5.73"
                                            fill="#F1633A"></path>
                                        <path pid="10"
                                            d="M30.119 37.88a5.738 5.738 0 01-5.731-5.73c0-3.16 2.572-5.73 5.73-5.73 3.16 0 5.733 2.57 5.733 5.73a5.738 5.738 0 01-5.732 5.73m.001-19.284c-7.475 0-13.555 6.081-13.555 13.553 0 7.474 6.08 13.555 13.555 13.555 7.473 0 13.554-6.081 13.554-13.555 0-7.472-6.08-13.553-13.554-13.553"
                                            fill="#FEFEFE"></path>
                                        <path pid="11"
                                            d="M30.12 18.596c-7.475 0-13.555 6.08-13.555 13.554 0 7.473 6.08 13.553 13.555 13.553 7.473 0 13.554-6.08 13.554-13.553 0-7.474-6.08-13.554-13.554-13.554m0 27.72c-7.812 0-14.167-6.356-14.167-14.166 0-7.812 6.355-14.166 14.167-14.166 7.81 0 14.166 6.354 14.166 14.166 0 7.81-6.355 14.167-14.166 14.167"
                                            fill="#020303"></path>
                                        <path pid="12" fill="#020303" d="M30.336 32.69l-.433-.431L58.477 3.684l.432.434z">
                                        </path>
                                        <path pid="13"
                                            d="M31.536 33.79a3.44 3.44 0 01-2.537-2.794l-.036-.234.604-.096.039.234a2.825 2.825 0 002.083 2.297l-.153.594z"
                                            fill="#22262A"></path>
                                        <path pid="14"
                                            d="M12.126 68l4.104-7.506-1.802 3.294a30.042 30.042 0 01-4.292-2.64l2.37-4.248h-.002L6.311 68h5.815zM48.112 68h5.816l-6.194-11.1c-.128.092-.26.178-.39.269.128-.09.26-.177.39-.27l2.368 4.25a29.965 29.965 0 01-4.291 2.64l-2.357-4.307L48.112 68z"
                                            fill="#F1633A"></path>
                                    </g>
                                </svg>
                            </div>
                            <p>{{ $heading['feature_2'] ?? null }}</p>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-4">
                        <div class="single-invest-card bg-gray-100 py-12 px-10 rounded-lg text-center mb-50">
                            <div class="invest-icon mb-4">
                                <svg version="1.1" viewBox="0 0 65 63" class="svg-icon svg-fill"
                                    style="width: 64px; height: auto; margin: auto;">
                                    <defs>
                                        <pattern id="svgicon_text-bubble_b" width="4.973" height="4.973" x="-4.973"
                                            y="-4.973" patternUnits="userSpaceOnUse">
                                            <use xlink:href="#svgicon_text-bubble_a" transform="scale(.49732)"></use>
                                        </pattern>
                                        <image id="svgicon_text-bubble_a" width="10" height="10"
                                            xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAABGdBTUEAALGOfPtRkwAAAYNpQ0NQSUNDIFByb2ZpbGUAACiRlZE9SMNQFIVPKlKU+jOIiFNA6VSlVBAFEdoMInSopYOKDvlrWqhJSGNVdBR0LDiILopdHJx1LbjqpCiCODm4F120xPuSaiqi4oFwv9x337vvngcEjkXTLAS6gSXdttJTCX52bp4PPqIN7XAlykUznkolGX/Er3q5Acfi1RA76/v6rwopalEGuB5iWzYtm3ibeGDFNhmfEPdYdCniKmPN42vGksdPbk0mLRC/EXeWZI32BkLEUV3J68QTxJNyTlSIN4gjUlO91sTefVz1C2IhL1mirSo8s0YwCoZVNEVZ/eeQf8lWV20WBcNcs/Jazubj5KTKT+vycISPRWNRgL2LV12bcf3mei/8nHEIjD0DLWU/J+0CZ1tA352fGzwAujaB03N52So12nOg7p5njX/uk/ATe766GgUqt0BmHUheAnv7QDhLfRaAVAflx2nCRf/zVMyOxLyzQgmg9cFxamEguAPUy47zeuQ49QrNcw9U9XcUym+KdBRqyQAAADhlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAAqACAAQAAAABAAAACqADAAQAAAABAAAACgAAAAAYsJrPAAAAFUlEQVQYGWNgIA78J0bZqCIG6gUBAO0QCfcp73TaAAAAAElFTkSuQmCC">
                                        </image>
                                    </defs>
                                    <g fill-rule="nonzero" fill="none">
                                        <path pid="0" fill="#FEFEFE" d="M0 0v45.44h14.221v13.956L32.35 45.44H65V0z"></path>
                                        <path pid="1" fill="#909294"
                                            d="M0 48.905h14.221v-3.468H0zM32.35 45.439L14.22 59.397v3.466L32.35 48.907H65v-3.468z">
                                        </path>
                                        <path pid="2" fill-opacity=".4" fill="url(#svgicon_text-bubble_b)"
                                            d="M32.934 0v45.44h-.585L14.222 59.395V45.44H0V0z"></path>
                                        <path pid="3" fill="#22262A"
                                            d="M10.34 12.714h44.318v-1.407H10.34zM10.34 23.642h44.318v-1.407H10.34zM10.34 34.572h44.318v-1.407H10.34z">
                                        </path>
                                        <path pid="4" d="M24.005 12.01a3.166 3.166 0 11-6.331.001 3.166 3.166 0 016.33 0"
                                            fill="#F4633A"></path>
                                        <path pid="5"
                                            d="M20.839 7.79a4.225 4.225 0 00-4.221 4.22 4.226 4.226 0 004.22 4.222 4.226 4.226 0 004.222-4.222 4.225 4.225 0 00-4.221-4.22m0 1.054a3.166 3.166 0 11-.001 6.333 3.166 3.166 0 010-6.333"
                                            fill="#FEFEFE"></path>
                                        <path pid="6" d="M44.682 19.774a3.166 3.166 0 110 6.332 3.167 3.167 0 110-6.332"
                                            fill="#F4633A"></path>
                                        <path pid="7"
                                            d="M44.682 18.718a4.227 4.227 0 00-4.222 4.222 4.226 4.226 0 004.222 4.22 4.226 4.226 0 004.221-4.22 4.226 4.226 0 00-4.22-4.222m0 1.056a3.166 3.166 0 110 6.332 3.167 3.167 0 110-6.332"
                                            fill="#FEFEFE"></path>
                                        <path pid="8" d="M29.686 30.702a3.166 3.166 0 110 6.331 3.166 3.166 0 010-6.33"
                                            fill="#F4633A"></path>
                                        <path pid="9"
                                            d="M29.686 29.647a4.225 4.225 0 00-4.221 4.22 4.225 4.225 0 004.22 4.222 4.225 4.225 0 004.222-4.221 4.225 4.225 0 00-4.221-4.221m0 1.055a3.166 3.166 0 110 6.333 3.166 3.166 0 010-6.333"
                                            fill="#FEFEFE"></path>
                                    </g>
                                </svg>
                            </div>
                            <p>{{ $heading['feature_3'] ?? null }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Investment Card -->
    @endif
@endsection
