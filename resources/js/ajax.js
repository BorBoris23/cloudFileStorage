$(document).ready (
    function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.renameDirectoryButton').click(function () {
            renameDirectory();
        });

        $('.deleteButton').click(function () {
            deleteFile();
        });

        $('.renameFileButton').click(function () {
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

        function deleteFile() {
            $('.workToFileForm').bind('submit', function(e) {
                e.preventDefault();
                let pathTo = $(this).find('input[name=pathTo]').val();
                let data = `pathTo=${pathTo}`;
                $(this).closest('div.fileContainer').remove();
                $.ajax({
                    type: "DELETE",
                    data: data,
                    url: `/workToFile`,
                    success: function () {
                        $('.workToFileForm').unbind('submit');
                        // if($('.filesListContainer').length === 0) {
                        //     $('.formContainer').append('<p class="textColor">no files</p>');
                        // }
                    }
                });
            });
        }

        function updateFile() {
            $('.workToFileForm').bind('submit', function(e) {
                e.preventDefault();
                let parent = $(this).closest('div.fileContainer');
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
                        parent.find('p[class=fileText]').html(`${newPathToFile}`);
                    }
                });
            });
        }

        function renameDirectory() {
            $('.workToDirectoryForm').bind('submit', function(e) {
                e.preventDefault();
                let parent = $(this).closest('div.fileContainer');
                let pathTo = $(this).find('input[name=pathTo]').val();
                let newPath = $(this).find('input[name=newDirectoryName]').val();
                let oldPath = $(this).find('input[name=oldDirectoryName]').val();
                let data = `pathTo=${pathTo}&newDirectoryName=${newPath}&oldDirectoryName=${oldPath}`;
                $.ajax({
                    type: "PATCH",
                    data: data,
                    url: `/renameDirectory`,
                    success: function () {
                        $('.workToDirectoryForm').unbind('submit');
                        parent.find('a[class=fileText]').html(`${newPath}`);
                    }
                });
            });
        }

        $('.searchInput').keyup($.debounce(250, function() {
            $('.searchInput').on("keypress", function (event) {
                let keyPressed = event.keyCode || event.which;
                if (keyPressed === 13) {
                    event.preventDefault();
                    return false;
                }
            });
            if($(this).val().length !== 0) {
                search($(this).val());
            }
            else {
                $('.list-group').remove();
            }
        }));

        function search(thisInput) {
            let data = `searchText=${thisInput}`;
            $.ajax({
                type: "POST",
                data: data,
                url: `/search`,
                success: function (response) {
                    $('.list-group').remove();
                    $('.modal-content').append(createLinkContainer(response));
                }
            });
        }

        function createLinkContainer(response)
        {
            let itemContainer = document.createElement('div');
            itemContainer.setAttribute('class', 'list-group');
            for(let i = 0; i < response.length; i ++) {
                let path = response[i].path;
                let name = response[i].name;
                itemContainer.appendChild(createLinkItem(path, name));
            }
            return itemContainer;
        }

        function createLinkItem(path, name)
        {
            let linkPath = '/?path='+`${path}`
            if(path === '') {
                linkPath = '/';
            }
            let item = document.createElement('a');
            item.setAttribute('class', 'list-group-item list-group-item-action dashboardContainer');
            item.setAttribute('href', `${linkPath}`);
            item.textContent = `${name}`;
            return item;
        }
    }
)
