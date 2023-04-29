<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
    <style>
        .error {
            color: red;
        }

        .delete-link {
            color: red;
            text-decoration: none;
        }

        .edit-link {
            color: green;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="container mt-5" style="max-width: 750px">
        <div class="row">
            <form>
                <input type="hidden" id="form-action" value="add">
                <input type="hidden" id="id" value="">
                <div class="form-group row p-1">
                    <label for="name" class="col-sm-2 col-form-label">Name<span class="error">*</span>:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" placeholder="A-Z">
                        <span class="error" id="nameError"></span>
                    </div>
                </div>
                <div class="form-group row p-1">
                    <label for="email" class="col-sm-2 col-form-label">Email<span class="error">*</span>:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" placeholder="Email">
                        <span class="error" id="emailError"></span>
                    </div>
                </div>

                <div class="form-group row p-1">
                    <label for="email" class="col-sm-2 col-form-label">Phone<span class="error">*</span>:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="phone" placeholder="0-9" maxlength="10">
                        <span class="error" id="phoneError"></span>
                    </div>
                </div>

                <div class="form-group row p-1">
                    <label for="email" class="col-sm-2 col-form-label">Gender<span class="error">*</span>:</label>
                    <div class="col-sm-10 p-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" checked id="male"
                                value="1">
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="2">
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                    </div>
                    <span class="error" id="genderError" style="padding-left: 18%;"></span>
                </div>

                <div class="form-group row p-1">
                    <label for="email" class="col-sm-2 col-form-label">Education<span
                            class="error">*</span>:</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="education_id">
                            <option value="">Select Education</option>
                            @foreach ($education as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <span class="error" id="educationError" style="padding-left: 18%;"></span>
                </div>

                <div class="form-group row p-1">
                    <label for="email" class="col-sm-2 col-form-label">Hobby<span class="error">*</span>:</label>
                    <div class="col-sm-10 p-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input hobby_checkbox" type="checkbox" id="cricket"
                                value="cricket" name="hobby" checked>
                            <label class="form-check-label" for="cricket">Cricket</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input hobby_checkbox" type="checkbox" id="singing"
                                value="singing" name="hobby" checked>
                            <label class="form-check-label" for="singing">Singing</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input hobby_checkbox" type="checkbox" id="travelling"
                                value="travelling" name="hobby" checked>
                            <label class="form-check-label" for="travelling">Travelling</label>
                        </div>
                    </div>
                    <span class="error" id="hobbyError" style="padding-left: 18%;"></span>
                </div>

                <div class="form-group row p-1">
                    <label for="email" class="col-sm-2 col-form-label">Company<span
                            class="error">*</span>:</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="company_id">
                            <option value="">Select Company</option>
                            @foreach ($company as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <span class="error" id="companyError" style="padding-left: 18%;"></span>
                </div>

                <div class="form-group row p-1">
                    <label for="email" class="col-sm-2 col-form-label">Experience<span
                            class="error">*</span>:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="experience" placeholder="1 Year 5 Month">
                        <span class="error" id="experienceError"></span>
                    </div>
                </div>

                <div class="form-group row p-1">
                    <label for="email" class="col-sm-2 col-form-label">Picture<span
                            class="error">*</span>:</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="image"
                            accept="image/jpg,image/jpeg,image/gif,image/png">
                        <span class="error" id="imageError"></span>
                    </div>
                    <div class="col-sm-2 preview-div" style="display:none">Preview</div>
                    <div class="col-sm-10 preview-div" style="display:none">
                        <img src="" id="preview-picture" alt="Picture" width="107" height="100" />
                    </div>
                </div>

                <div class="form-group row p-1">
                    <label for="email" class="col-sm-2 col-form-label">Message<span
                            class="error">*</span>:</label>
                    <div class="col-sm-10">
                        <textarea id="message" rows="5" class="form-control" placeholder="Message"></textarea>
                        <span class="error" id="messageError"></span>
                    </div>
                </div>

                <div class="form-group row p-1">
                    <label for="email" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="button" class="btn btn-primary" id="submit">Submit</button>
                        <button type="button" class="btn btn-secondary" onclick="clearFormData();">Reset</button>
                    </div>
                </div>

                <div class="form-group row p-1">
                    <label for="email" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">

                    </div>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="form-group col-md-4 p-0">
                <input type="text" class="form-control" id="search-input" placeholder="Search">
            </div>
            <div class="form-group col-md-4">
                <button type="button" class="btn btn-primary" id="clear-btn">Clear</button>
            </div>

            <table class="table table-bordered" id="data-wrapper">
                <thead>
                    <tr>
                        <th scope="col">Sr No.</th>
                        <th scope="col">Name</th>
                        <th scope="col">Hobby</th>
                        <th scope="col">Email</th>
                        <th scope="col">Picture</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="table-tbody">

                </tbody>
            </table>
        </div>


        <div class="text-center" id="showmore-div" style="display:none;">
            <button class="btn btn-success load-more-data"><i class="fa fa-refresh"></i> Show More</button>
        </div>

        <!-- Data Loader -->
        <div class="auto-load text-center" style="display: none;">
            <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="60"
                viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                <path fill="#000"
                    d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                    <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                        from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                </path>
            </svg>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script>
        var ENDPOINT = "{{ route('user.data') }}";
        var page = 1;
        var search = "";
        var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
        var baseUrl = "{{ url('/') . '/' }}";
        $(document).ready(function(e) {
            $('#submit').click(function() {
                var files = $('#image')[0].files;
                var fileType = " ";
                var validImageTypes = [];
                if (files.length > 0) {
                    fileType = files[0]['type'];
                    validImageTypes = ['image/gif', 'image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                }

                var name = $("#name").val();
                var email = $("#email").val();
                var phone = $("#phone").val();
                var gender = $("input[name='gender']:checked").val();
                var education_id = $("#education_id").val();
                var company_id = $("#company_id").val();
                var hobbyArr = [];
                $.each($("input[name='hobby']:checked"), function() {
                    hobbyArr.push($(this).val());
                });
                var hobby = hobbyArr.join(", ");
                var experience = $("#experience").val();

                var message = $("#message").val();
                var formAction = $("#form-action").val();
                var id = $("#id").val();
                var name_regex = /^[A-Za-z ]+$/;
                var email_regex = /^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/;
                var phone_regex = /^[0-9]+$/;
                var fd = new FormData();
                var temp = 0;

                if (name.trim() == "") {
                    temp++;
                    $("#name").focus();
                    $("#nameError").html("Please enter Name.");
                } else if (!name_regex.test(name.trim())) {
                    temp++;
                    $("#name").focus();
                    $("#nameError").html("Please enter only characters.");
                } else {
                    $("#nameError").html("");
                }

                if (email.trim() == "") {
                    temp++;
                    $("#email").focus();
                    $("#emailError").html("Please enter Email.");
                } else if (!email_regex.test(email.trim())) {
                    temp++;
                    $("#email").focus();
                    $("#emailError").html("Please enter valid Email.");
                } else {
                    $("#emailError").html("");
                }

                if (phone.trim() == "") {
                    temp++;
                    $("#phone").focus();
                    $("#phoneError").html("Please enter Phone.");
                } else if (!phone_regex.test(phone.trim())) {
                    temp++;
                    $("#phone").focus();
                    $("#phoneError").html("Please enter valid Phone.");
                } else if (phone.trim().length < 10) {
                    temp++;
                    $("#phone").focus();
                    $("#phoneError").html("Please enter 10 digit Phone.");
                } else {
                    $("#phoneError").html("");
                }

                if (education_id == "") {
                    temp++;
                    $("#education_id").focus();
                    $("#educationError").html("Please select Education.");
                } else {
                    $("#educationError").html("");
                }

                if (company_id == "") {
                    temp++;
                    $("#company_id").focus();
                    $("#companyError").html("Please select Company.");
                } else {
                    $("#companyError").html("");
                }

                if (hobby == "") {
                    temp++;
                    $("#cricket").focus();
                    $("#hobbyError").html("Please select Hobby.");
                } else {
                    $("#hobbyError").html("");
                }

                if (experience.trim() == "") {
                    temp++;
                    $("#experience").focus();
                    $("#experienceError").html("Please enter Experience.");
                } else {
                    $("#experienceError").html("");
                }

                if (files.length < 1 && formAction == "add") {
                    temp++;
                    $("#image").focus();
                    $("#imageError").html("Please select Image.");
                } else if (files.length > 0 && $.inArray(fileType, validImageTypes) < 0 ) {
                    temp++;
                    $("#image").focus();
                    $("#imageError").html("Invalid file type, only support: jpg,jpeg,gif,png.");
                } else {
                    $("#imageError").html("");
                }

                if (message.trim() == "") {
                    temp++;
                    $("#message").focus();
                    $("#messageError").html("Please enter Message.");
                } else {
                    $("#messageError").html("");
                }

                if (temp != 0) {
                    return false;
                } else {
                    fd.append('action', formAction);
                    fd.append('id', id);
                    fd.append('_token', CSRF_TOKEN);
                    fd.append('name', name);
                    fd.append('email', email);
                    fd.append('phone', phone);
                    fd.append('gender', gender);
                    fd.append('education_id', education_id);
                    fd.append('company_id', company_id);
                    fd.append('hobby', hobby);
                    fd.append('experience', experience);
                    if (files.length > 0) {
                        fd.append('image', files[0]);
                    }
                    fd.append('message', message);

                    $.ajax({
                        url: "{{ route('add.user.data') }}",
                        method: 'post',
                        data: fd,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(response) {
                            if (response.user == "add") {
                                clearFormData();
                                $("#table-tbody").html("");
                                infinteLoadMore(1, "");
                                setTimeout(() => {
                                    toastr.success("Successfully created.");
                                }, 1000);
                            }
                            if (response.user == "update") {
                                clearFormData();
                                $("#table-tbody").html("");
                                infinteLoadMore(1, "");
                                setTimeout(() => {
                                    toastr.success("Successfully updated.");
                                }, 1000);
                            }
                        },
                        error: function(response) {
                            console.log("error : " + JSON.stringify(response));
                        }
                    });
                }
            });

            infinteLoadMore(page, search);
            $("#search-input").keyup(function() {
                if ($(this).val().length < 0) {
                    return false;
                } else {
                    $("#table-tbody").html("");
                    search = $(this).val();
                    infinteLoadMore(page, search);
                }
            });
        });

        $(".load-more-data").click(function() {
            page++;
            infinteLoadMore(page, search);
        });
        1

        $("#clear-btn").click(function() {
            page = 1;
            search = "";
            $("#table-tbody").html("");
            $("#search-input").val("");
            infinteLoadMore(page, search);
        });

        function clearFormData() {
            $(".preview-div").css("display", "none");
            $("#name").val("");
            $("#nameError").html("");
            $("#email").val("");
            $("#emailError").html("");
            $("#phone").val("");
            $("#phoneError").html("");
            $("#male").prop('checked', true);
            $("#genderError").html("");
            $("#education_id").val("");
            $("#educationError").html("");
            $("#company_id").val("");
            $("#companyError").html("");
            $(".hobby_checkbox").prop('checked', true);
            $("#hobbyError").html("");
            $("#experience").val("");
            $("#experienceError").html("");
            $("#message").val("");
            $("#messageError").html("");
            $("#form-action").val("add");
            $("#id").val("");
            $("#image").val("");
            $("#imageError").html("");
            $("#submit").html("Submit");
        }

        function editUser(id) {
            clearFormData();
            var upUrl = "{{ route('edit.user.data', 'id') }}"
            var url = upUrl;
            url = url.replace('id', id);
            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    if (response) {
                        $(".hobby_checkbox").prop("checked",false);
                        var stringHobby = response.hobby;
                        var splitHobby = stringHobby.split(',');
                        $.each(splitHobby, function(key,value) {
                            $("#"+$.trim(value)).prop("checked",true);
                        });
                        $("#name").focus();
                        $("#id").val(response.id);
                        $("#form-action").val("update");
                        $("#name").val(response.name);
                        $("#email").val(response.email);
                        $("#phone").val(response.phone);
                        if (response.gender == 1) {
                            $("#male").prop("checked", true);
                        } else {
                            $("#female").prop("checked", true);
                        }
                        $("#education_id").val(response.education_id);
                        $("#company_id").val(response.company_id);
                        $("#experience").val(response.experience);
                        $("#message").val(response.message);
                        $(".preview-div").css("display", "block");
                        $("#preview-picture").prop("src", response.image);
                        $("#submit").html("Update");
                    }
                }
            });
        }

        function deleteUser(id) {
            var upUrl = "{{ route('delete.user.data', 'id') }}"

            Swal.fire({
                title: 'Are you sure?',
                text: "you want to delete this record?",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                confirmButtonClass: "btn btn-success mt-2 m-sm-1 btn-sm",
                cancelButtonClass: "btn btn-danger ml-2 m-sm-1 btn-sm",
                buttonsStyling: !1
            }).then((result) => {
                var url = upUrl;
                url = url.replace('id', id);
                if (result.value) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': CSRF_TOKEN
                        },
                        async: false,
                        url: url,
                        type: "DELETE",
                        success: function(response) {
                            if (response) {
                                $("#table-tbody").html("");
                                infinteLoadMore(1, "");
                                setTimeout(() => {
                                    toastr.success("Successfully deleted.");
                                }, 1000);
                            }
                        }
                    });
                } else {
                    return false;
                }
            });
        }


        function infinteLoadMore(page, search) {
            $.ajax({
                    url: ENDPOINT + "?page=" + page + "&search=" + search,
                    datatype: "html",
                    type: "get",
                    beforeSend: function() {
                        $('.auto-load').show();
                    }
                })
                .done(function(response) {
                    var html = '';
                    var count = 1;
                    var rowCount = $('#table-tbody tr').length;
                    if (response.users.data.length > 0) {
                        $.each(response.users.data, function(key, value) {
                            rowCount++;
                            html += '<tr><td>' + rowCount + '</td><td>' + value.name + '</td><td>' + value
                                .hobby + '</td><td>' + value.email + '</td><td align="center"><img src="' +
                                baseUrl + value.image +
                                '" alt="Photo" height="80" width="80" /></td><td><a href="javascript:void(0);" class="edit-link" onclick="editUser(' +
                                value.id +
                                ');">Edit</a> | <a href="javascript:void(0);" class="delete-link" onclick="deleteUser(' +
                                value.id + ');">Delete</a></td></tr>';
                        });
                        if (search == "") {
                            $("#table-tbody").append(html);
                        } else {

                            $("#table-tbody").html(html);
                        }

                        if (response.users.next_page_url != null) {
                            $("#showmore-div").css("display", "block");
                        } else {
                            $("#showmore-div").css("display", "none");
                        }
                    } else {
                        html += '<tr><td align="center" colspan="6">No data available.</td></tr>';
                        $("#table-tbody").html(html);
                    }
                    $('.auto-load').hide();
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    console.log('Server error occured');
                });
        }
    </script>
</body>

</html>
