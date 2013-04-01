$(function() {
    $(".task-list").sortable({
	connectWith: ".task-list",
        receive: function(event, ui) {
                if ((this.id == 'done') && (confirm("Are you sure you want to move ticket [" + ui.item.attr("id") + "] to [" + this.id + "] "))) {
                        $.ajax({
                                type: "POST",
                                url: "newStatus.php",
                                data: {
                                        ticket: ui.item.attr("id"),
                                        newStatus: this.id
                                },
                                success: function(response) {
                                        alert(response);
                                }
                        });
                }
		else if (this.id != 'done') {
                        $.ajax({
                                type: "POST",
                                url: "newStatus.php",
                                data: {
                                        ticket: ui.item.attr("id"),
                                        newStatus: this.id
                                }
                        });
		}
		else {
			$(ui.sender).sortable("cancel");
			alert('Canceling');
		}
	

        },
        tolerance: "pointer",
        appendTo: 'body',
        helper: 'clone',
        zIndex: 666
    }).disableSelection();
});
