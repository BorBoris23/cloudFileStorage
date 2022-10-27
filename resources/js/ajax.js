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

        $('.filesHidden').change(function ()
        {
            let files = this.files;
            $('.filesArea').append('<ul class="filesList"></ul>');
            for (let i = 0; i < files.length; i++) {
                $('.filesList').append('<li>' + files[i].name + '</li>');
            }
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
                            $('.formContainer').append('<p class="textColor">no files</p>');
                        }
                    }
                });
            });
        }
    }
)

