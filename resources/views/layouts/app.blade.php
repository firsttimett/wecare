<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WeCare') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div>
        @include('inc.navbar')
        <main id="app" class="py-4">
            @include('inc.messages')

            <div id="jQuery_Generated_HTML"></div>

            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function(){
            if (location.pathname == "/users" || 
                location.pathname.substring(0, location.pathname.indexOf("/", 4)) == "/users")
            {
                $("li").first().addClass("active").attr('style', 'background-color: #e9ecef');
            }
            else if (location.pathname == "/tests" || 
                    location.pathname.substring(0, location.pathname.indexOf("/", 4)) == "/tests")
            {
                $("li").first().next().addClass("active").attr('style', 'background-color: #e9ecef');
            }
            else
            {
                $("li.dropdown").addClass("active").attr('style', 'background-color: #e9ecef');
            }
        });

        $(".alert.alert-success").show("slow").delay(3000).slideUp(200, function() {
            $(this).alert('close');
        });
        
        

        var button = null;

        $('#deleteModal').on('show.bs.modal', function (ev) {
            button = $(ev.relatedTarget);
            $("#deletecontent").text(button.data("text"));
        })
        
        $("#yes").on("click", function (ev) {
            // if (location.pathname.substr(-4) != "edit"){
                $.ajax({
                    type: "POST",
                    url: button.data("url"),
                    data: { _method: 'DELETE', _token: button.data("token") },
                    dataType: 'text',
                    success: function (text) {
                        $("#deleteModal").modal("hide");

                        button.closest("tr").remove();
                        customAlert(text);

                        // If no more user, display jumbotron
                        if ($("tr").length == 1){
                            var table = $("table");

                            if (location.pathname == "/users"){
                                table.parent().append(`<div class="jumbotron mt-3">
                                                            <h3 class="text-center text-muted">
                                                                No psychologist
                                                            </h3>
                                                        </div>`);
                            }
                            else if (location.pathname == "/tests"){
                                table.parent().append(`<div class="jumbotron mt-3">
                                                            <h3 class="text-center text-muted">
                                                                No Screening Test
                                                            </h3>
                                                        </div>`);
                            }
                            
                            table.remove();
                        }
                        else{
                            resetTableNumber();
                        } 
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown){
                        console.log("Opps: AJAX error");
                    }
                });
            // }
            // else { // Screening Test Edit

            // }

            ev.preventDefault();
        });

        function resetTableNumber(){
            var tableRows = $("tr").length - 1;
            var tdEq = 0;

            for (var i = 1; i <= tableRows; i ++){
                $("td" + ":eq(" + tdEq + ")").html(i);
                tdEq += 3;
            }
        }

        function customAlert(text){
            var html =  `<div class="container alert alert-success alert-dismissible fade show" role="alert" style="display: none">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>` +
                            text +
                        `</div>`;
            $("#jQuery_Generated_HTML").html(html);

            $(".alert.alert-success").show("slow").delay(3000).slideUp(200, function() {
                $(this).alert('close');
                $("#jQuery_Generated_HTML").html("");
            });
        }
    </script>
    @yield('javascript')
</body>
</html>
