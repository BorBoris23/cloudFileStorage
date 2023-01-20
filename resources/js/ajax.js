$(document).ready (
    function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.filesHidden').change(function ()
        {
            let files = this.files;
            $('.filesArea').append('<ul class="filesList"></ul>');
            for (let i = 0; i < files.length; i++) {
                $('.filesList').append('<li>' + files[i].name + '</li>');
            }
        });

        $('.deleteFile').click(function () {
            $(this).closest('div.fileContainer').remove();
            deleteFile($(this).attr('path'));
        });

        function deleteFile(path) {
            $.ajax({
                type: "DELETE",
                dataType: "json",
                url: `/api/file?path=${path}`,
                success: function () {
                    $('.workToFileForm').unbind('submit');
                    if ( $('.content').children().length === 0 ) {
                        $('.breadcrumbsContainer').remove();
                    }
                }
            });
        }

        $('.renameFile').click(function () {
            renameFile();
        });

        function renameFile() {
            $('.workToFileForm').bind('submit', function(e) {
                e.preventDefault();
                let parent = $(this).closest('div.fileContainer');
                let path = $(this).find('input[name=pathTo]').val();
                let newPath = $(this).find('input[name=newFileName]').val();
                let oldPath = $(this).find('input[name=oldFileName]').val();
                $.ajax({
                    type: "PATCH",
                    dataType: "json",
                    url: `/api/file?path=${path}&newPath=${newPath}&oldPath=${oldPath}`,
                    success: function () {
                        $('.workToFileForm').unbind('submit');
                        parent.find('p[class=fileText]').html(`${newPath}`);
                    }
                });
            });
        }

        $('.fileImg').dblclick(function() {
            let path = $(this).attr('path');
            downloadFile(path);
        });

        function downloadFile(path) {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: `/api/file?path=${path}`,
                success: function (response) {
                    let blob = new Blob([response]);
                    let link=document.createElement('a');
                    link.href=window.URL.createObjectURL(blob);
                    link.download = response.name;
                    link.click();
                }
            });
        }

        $('.renameDirectoryButton').click(function () {
            renameDirectory();
        });

        function renameDirectory() {
            $('.workToDirectoryForm').bind('submit', function(e) {
                e.preventDefault();
                let parent = $(this).closest('div.fileContainer');
                let path = $(this).find('input[name=pathTo]').val();
                let newPath = $(this).find('input[name=newDirectoryName]').val();
                let oldPath = $(this).find('input[name=oldDirectoryName]').val();
                $.ajax({
                    type: "PATCH",
                    dataType: "json",
                    url: `/api/directory?path=${path}&newPath=${newPath}&oldPath=${oldPath}`,
                    success: function (response) {
                        $('.workToDirectoryForm').unbind('submit');
                        parent.find('a[class=fileText]').html(`${response.newPath}`);
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
            $.ajax({
                type: "GET",
                dataType: "json",
                url: `/api/search?query=${thisInput}`,
                success: function (response) {
                    $('.list-group').remove();
                    if(response.length !== 0 ) {
                        $('.modal-content').append(createLinkContainer(response));
                    } else {
                        $('.modal-content').append(createMessage());
                    }
                }
            });
        }

        function createMessage()
        {
            let item = document.createElement('p');
            item.setAttribute('class', 'list-group list-group-item list-group-item-action dashboardContainer');
            item.textContent = 'no matches';
            return item;
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
