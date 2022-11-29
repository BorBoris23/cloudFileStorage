$(document).ready (
    function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.renameDirectoryButton').click(function () {
            let thisContainer = $(this).next('div.hiddenFormContainer');
            thisContainer.removeClass('hide');

            let thisLink = $(this).prev('a.directoryInput');
            thisLink.addClass('hide');

            let thisButton = $(this);
            thisButton.addClass('hide');
        });

        $('.cancelButton').click(function () {
            let thisContainer = $(this).parent('div.hiddenFormContainer');
            thisContainer.addClass('hide');

            let thisLink = thisContainer.siblings('a.directoryInput');
            thisLink.removeClass('hide');

            let thisButton = thisContainer.siblings('button.renameDirectoryButton');
            thisButton.removeClass('hide');
        });

        $('.renameButton').click(function () {
            renameDirectory();
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

        function renameDirectory() {
            $('.workToDirectoryForm').bind('submit', function(e) {
                e.preventDefault();
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
                $('.searchResult').remove();
            }
        }));

        function search(thisInput) {
            let data = `searchText=${thisInput}`;
            $.ajax({
                type: "POST",
                data: data,
                url: `/search`,
                success: function (response) {
                    $('.searchResult').remove();
                    $('.modal-content').append(createLinkContainer(response));
                }
            });
        }

        function createLinkContainer(response)
        {
            console.log(response);
            let itemContainer = document.createElement('div');
            itemContainer.setAttribute('class', 'searchResult');
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
            item.setAttribute('href', `${linkPath}`);
            item.textContent = `${name}`;
            return item;
        }
    }
)
