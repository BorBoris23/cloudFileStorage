$(document).ready (
    function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.deleteButton').click(function () {
            deleteFile();
        });

        $('.updateButton').click(function () {
            updateFile();
        });

        function updateFile() {
            $('.workToFileForm').bind('submit', function(e) {
                e.preventDefault();
                let pathToFile = $(this).find('input[name=pathToFile]').val();
                let newPathToFile = $(this).find('input[name=newFileName]').val();
                let data = `pathToFile=${pathToFile}&newFileName=${newPathToFile}`;
                $.ajax({
                    type: "PATCH",
                    data: data,
                    url: `/workToFileForm`,
                    success: function () {
                        $('.workToFileForm').unbind('submit');
                    }
                });
            });
        }

        function deleteFile() {
            $('.workToFileForm').bind('submit', function(e) {
                e.preventDefault();
                let pathToFile = $(this).find('input[name=pathToFile]').val();
                let data = `pathToFile=${pathToFile}`;
                $(this).parent().remove();
                $.ajax({
                    type: "DELETE",
                    data: data,
                    url: `/workToFileForm`,
                    success: function () {
                        $('.workToFileForm').unbind('submit');
                        if($('.filesListContainer').length === 0) {
                            $('.formContainer').append('<p>no files</p>');
                        }
                    }
                });
            });
        }
    }
)
