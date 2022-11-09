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
                let pathTo = $(this).find('input[name=pathTo]').val();
                let newPathToFile = $(this).find('input[name=newFileName]').val();
                let oldPathToFile = $(this).find('input[name=oldFileName]').val();
                let data = `pathTo=${pathTo}&newFileName=${newPathToFile}&oldFileName=${oldPathToFile}`;
                $.ajax({
                    type: "PATCH",
                    data: data,
                    url: `/workToFile`,
                    success: function () {
                        $('.workToFileForm').unbind('submit');
                    }
                });
            });
        }

        function deleteFile() {
            $('.workToFileForm').bind('submit', function(e) {
                e.preventDefault();
                let pathTo = $(this).find('input[name=pathTo]').val();
                let data = `pathTo=${pathTo}`;
                $(this).parent().remove();
                $.ajax({
                    type: "DELETE",
                    data: data,
                    url: `/workToFile`,
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

