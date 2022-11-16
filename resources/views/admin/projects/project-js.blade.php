<script>
    var count = {{ is_array($project->meta->value['icon'] ?? 0) ? count($project->meta->value['icon']) : 1 }};;
    var wrapper = $('.field_wrapper');

    //Once add button is clicked
    $('.add_button').on('click', function() {
        var fieldHTML = `<div class="row mt-3">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" data-key="${count}" class="form-control" name="text[${count}]" id="text" placeholder="Text" autocomplete="off" required>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary btn-sm myEditor_icon" data-id="${count}"></button>
                                </div>
                            </div>
                            <input type="hidden" data-key="${count}" name="icon[]" class="item-${count}" required>
                        </div>
                        <div class="col-md-5">
                            <input type="number" data-key="0" name="item[${count}]" class="form-control" placeholder="{{ __("Number") }}" required>
                        </div>
                        <div class="col-md-1 text-right">
                            <a href="javascript:void(0);" class="remove_button text-xxs mr-2 btn btn-danger rounded-circle mb-0 btn-sm  text-xxs mt-1" title="Remove">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                </svg>
                            </a>
                        </div>
                    </div>`;

        $(wrapper).append(fieldHTML);
        $('.myEditor_icon').iconpicker();
        count++;
    });

    $(document).on('change', '.myEditor_icon', function(e) {
        console.log(e.icon)
        $('.item-'+$(this).data('id')).val(e.icon);
    });

    $(wrapper).on('click', '.remove_button', function(e) {
        e.preventDefault();
        $(this).parent('div').parent('div.row').remove();
    });
</script>
