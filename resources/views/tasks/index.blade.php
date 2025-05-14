<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    new Sortable(document.getElementById('task-list'), {
        animation: 150,
        onEnd: function(evt) {
            let taskIds = [];
            let items = document.querySelectorAll('#task-list li');
            items.forEach(function(item) {
                taskIds.push(item.getAttribute('data-id'));
            });

            fetch('/tasks/reorder', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    order: taskIds
                })
            });
        }
    });