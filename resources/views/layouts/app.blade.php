<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>@yield('title') | {{ get_system_title() }}</title>

    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="">
    <meta property="og:site_name" content="">
    <meta property="og:description" content="">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <!-- CSRF Token -->

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="{{ asset('backend/assets') }}/media/favicons/favicon.png">
    <link rel="icon" type="image/png" sizes="192x192"
        href="{{ asset('backend/assets') }}/media/favicons/favicon-192x192.png">
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('backend/assets') }}/media/favicons/apple-touch-icon-180x180.png">
    <!-- END Icons -->


    @stack('css')

    <!-- Stylesheets -->
    <!-- Fonts and Dashmix framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('backend/assets') }}/js/plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" id="css-main" href="{{ asset('backend/assets') }}/css/dashmix.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
    @stack('styles')

</head>

<body style="background-color: #f8f9fc;">
    <!-- Page Container -->

    <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed @if(get_system_setting()->enabled_dark_mode) dark-mode @endif">
        <!-- Side Overlay-->
        {{-- @include('theme.core.includes.side-overlay') --}}
        @include('includes.side-overlay')
        <!-- END Side Overlay -->

        <!-- Sidebar -->
        {{-- @include('theme.core.includes.sidebar') --}}
        @include('includes.sidebar')
        <!-- END Sidebar -->

        <!-- Header -->
        @include('includes.header')
        <!-- END Header -->

        <!-- Main Container -->
        <main id="main-container">
            <!-- Hero -->
            <div class="bg-body-light">
                <div class="content content-full py-0">
                    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                        @yield('breadcrumb')
                    </div>
                </div>
            </div>
            <!-- END Hero -->

            <!-- Page Content -->
            <div class="content mt-0 pt-0">
                @yield('content')
            </div>
            <!-- END Page Content -->
        </main>
        <!-- END Main Container -->

        <!-- Footer -->
        @include('includes.footer')
        <!-- END Footer -->
    </div>
    <!-- END Page Container -->


    <!-- Large Block Modal for create branch -->
    <div class="modal fade view-modal" aria-labelledby="modal-block-large" aria-hidden="true" style="z-index: 1051;">

    </div>
    <!-- END Large Block Modal for create branch-->


    <script src="{{ asset('backend/assets') }}/js/dashmix.app.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://malsup.github.io/jquery.form.js"></script>
    <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
    <script src="{{ asset('backend/assets') }}/js/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{ asset('backend/assets') }}/js/bootstrap-notify.min.js"></script>

    @stack('js')
    @stack('scripts')



    <script>
        const position_parent = document.getElementsByClassName('active')[3].offsetParent.offsetTop;
        const position_child = document.getElementsByClassName('active')[3].offsetTop;
        const el = new SimpleBar(document.getElementById('sidebar'));

        if (position_parent <= 0) {
            el.getScrollElement().scrollTo(0, position_child);
        } else {
            el.getScrollElement().scrollTo(0, position_parent);

        }

        //   console.log(position_child);
        //   console.log(document.getElementsByClassName('active')[3].offsetParent.offsetTop)
    </script>

    <script>
        // view modal script 
        $(document).on('click', '.show-modal', function() {
            let self = $(this);
            let url = self.data('url');
            let old_text = self.text();
            self.html('<i class="fa fa-sync fa-spin"></i>');

            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'html',
                success: function(response) {
                    $('.view-modal').html(response).modal('show');
                    self.text(old_text);
                    Dashmix.helpersOnLoad(['jq-select2']);
                }
            });
        });

        $(document).on('change', '#english', function(e){
            e.preventDefault();
            const text = $(this).val();
            $.ajax({
                url: @json(route('english_to_arabic')),
                method: 'GET',
                dataType: 'json',
                data: {text:text},
                success: function(response){
                    console.log(response)
                    $('#arabic').val(response);
                }
            });
        })

        // submit form script 
        $(document).on('submit', '.submit-form', function(e) {
            e.preventDefault();
            let self = $(this);
            let url = self.attr('action');
            let data = self.serializeArray();
            let old_text = self.find('button[type="submit"]').text();
            self.find('button[type="submit"]').html('<i class="fa fa-sync fa-spin"></i>');
            self.find('button[type="submit"]').attr("disabled");

            let options = {
                // available options: 
                beforeSubmit: showRequest, // pre-submit callback 
                url: url, // override for form's 'action' attribute 
                type: 'post', // 'get' or 'post', override for form's 'method' attribute 
                dataType: 'json', // 'xml', 'script', or 'json' (expected server response type) 
                //clearForm: true        // clear all form fields after successful submit 
                // resetForm: true,        // reset the form after successful submit 
                success: function(response) {
                    get_notify(response)
                    self.find('button[type="submit"]').text(old_text);
                },
                error: function(response) {
                    console.log(response)
                    get_notify(response)
                    self.find('button[type="submit"]').text(old_text);
                },
                statusCode: {
                    404: function() {
                        Dashmix.helpers('jq-notify', {
                            type: 'danger',
                            icon: 'fa fa-times me-1',
                            message: 'Page or Url Not Found!'
                        });
                        self.find('button[type="submit"]').text(old_text);
                    },
                    500: function() {
                        Dashmix.helpers('jq-notify', {
                            type: 'danger',
                            icon: 'fa fa-times me-1',
                            message: 'Internal Server Error!'
                        });
                        self.find('button[type="submit"]').text(old_text);
                    },
                    419: function() {
                        Dashmix.helpers('jq-notify', {
                            type: 'danger',
                            icon: 'fa fa-times me-1',
                            message: 'Csrf Token mismatch!!'
                        });
                        self.find('button[type="submit"]').text(old_text);
                    },
                    405: function() {
                        Dashmix.helpers('jq-notify', {
                            type: 'danger',
                            icon: 'fa fa-times me-1',
                            message: 'Bad Method Call!!'
                        });
                        self.find('button[type="submit"]').text(old_text);
                    },

                }
            };

            // inside event callbacks 'this' is the DOM element so we first 
            // wrap it in a jQuery object and then invoke ajaxSubmit 
            $(this).ajaxSubmit(options);

            // !!! Important !!! 
            // always return false to prevent standard browser submit and page navigation 
            return false;
        });

        function showRequest(formData, jqForm, options) {
            // formData is an array; here we use $.param to convert it to a string to display it 
            // but the form plugin does this for you automatically when it submits the data 
            var queryString = $.param(formData);

            // jqForm is a jQuery object encapsulating the form element.  To access the 
            // DOM element for the form do this: 
            // var formElement = jqForm[0]; 

            // here we could return false to prevent the form from being submitted; 
            // returning anything other than false will allow the form submit to continue 
            return true;
        }


        // change status script 
        $(document).on('change', '.change-status', function() {
            let url = $(this).data('url');
            let status = $(this).val();


            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    status: status
                },
                dataType: 'json',
                success: function(response) {
                    get_notify(response);
                }
            })
        });



        // multiple delete script 
        $(document).on('click', '.delete-selected', function() {
            let e = Swal.mixin({
                buttonsStyling: !1,
                target: "#page-container",
                customClass: {
                    confirmButton: "btn btn-success m-1",
                    cancelButton: "btn btn-danger m-1",
                    input: "form-control"
                }
            });

            e.fire({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                icon: "warning",
                showCancelButton: !0,
                customClass: {
                    confirmButton: "btn btn-danger m-1",
                    cancelButton: "btn btn-secondary m-1"
                },
                confirmButtonText: "Yes, delete it!",
                html: !1,
                preConfirm: e => new Promise((e => {


                    let checkedVals = $('.checkbox:checkbox:checked').map(function() {
                        return this.value;
                    }).get();

                    let ids = checkedVals.join(",");
                    ids = ids.split(',');

                    let url = $(this).attr('url');

                    if (ids.length > 0 || ids.length != null) {
                        $.ajax({
                            url: url,
                            method: 'GET',
                            data: {
                                ids:ids
                            },
                            dataType: 'json',
                            success: function(response) {
                                get_notify(response)
                            }
                        })
                    }

                    setTimeout((() => {
                        e()
                    }), 50)
                }))
            }).then((t => {
                t.value ? e.fire("Deleted!", "Your imaginary file has been deleted.",
                    "success") : "cancel" === t.dismiss && e.fire("Cancelled",
                    "Your imaginary file is safe :)", "error")
            }));


        })

        // get notification script 
        function get_notify(response) {

            if (response.errors) {
                response.errors.forEach(error => {
                    Dashmix.helpers('jq-notify', {
                        type: 'danger',
                        icon: 'fa fa-info me-1',
                        message: error + ' !'
                    });
                });
            }


            if (response.error) {
                Dashmix.helpers('jq-notify', {
                    type: 'danger',
                    icon: 'fa fa-times me-1',
                    message: response.error + ' !'
                });
            }


            if (response.success) {
                Dashmix.helpers('jq-notify', {
                    type: 'success',
                    icon: 'fa fa-check me-1',
                    message: response.success + ' !'
                });

                if(typeof table !== 'undefined'){
                    table.ajax.reload();
                }
                
                $('.view-modal').modal('hide');
                $('.modal-backdrop').hide();
                $('body').css({
                    'overflow': 'auto',
                    'padding-right': '0'
                });
            }
        }

  

        let image_input = $('.image_input');
        let image_src = $('.image_src');

        $(document).on('click','.image_button',function(event){
            event.preventDefault();
            let parent = $(this).parents('a');

            image_input = parent.find('.image_input');
            image_src = parent.find('.image_src');

            window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
        });

        function fmSetLink($url) {
            let app_url = @json(config('app.url'));
            let file_path = $url.replace(app_url, '');

        
            image_input.val(file_path);
            image_src.attr('src', $url);
        }

        $('.js-select2').select2()
    </script>
</body>

</html>
