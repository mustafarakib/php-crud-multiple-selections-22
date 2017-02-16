<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="../../../resource/bootstrap/js/jquery.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
<!-- required for search, block 4 of 5 start -->
<form id="searchForm" action="index.php"  method="get" style="margin-top: 45px">
    <input type="text" value="" id="searchID" name="search" placeholder="Search" width="60" >
    <input type="checkbox"  name="byTitle"   checked  >By Title
    <input type="checkbox"  name="byAuthor"  checked >By Author
    <input hidden type="submit" class="btn-primary" value="search">
</form>
<!-- required for search, block 4 of 5 end -->


<!-- required for search, block 5 of 5 start -->
<script>
    $(function() {
        var availableTags = [
            "Asp", "BASIC", "C", "C++",
            "Clojure", "COBOL", "ColdFusion", "Erlang", "Fortran",
            "Groovy", "Haskell", "Java", "JavaScript", "Lisp", "Perl",
            "PHP", "Python", "Ruby", "Scala", "Scheme"
        ];

        // Filter function to search only from the beginning of the string
        $( "#searchID" ).autocomplete({
            source: function(request, response) {

                var results = $.ui.autocomplete.filter(availableTags, request.term);

                results = $.map(availableTags, function (tag) {
                    if (tag.toUpperCase().indexOf(request.term.toUpperCase()) === 0) {
                        return tag;
                    }
                });
                response(results.slice(0, 15));
            }
        });

        $( "#searchID" ).autocomplete({
            select: function(event, ui) {
                $("#searchID").val(ui.item.label);
                $("#searchForm").submit();
            }
        });
    });

</script>
<!-- required for search, block5 of 5 end -->

</body>
</html>
