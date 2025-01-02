function addFoodItem(event) {
    event.preventDefault();

    const formData = new FormData(event.target);
    fetch('/food-items', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: formData,
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Food item added successfully!');
                window.location.reload();
            } else {
                alert('Failed to add food item.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
}

function deleteFoodItem(foodItemId) {
    if (!confirm('Are you sure you want to delete this food item?')) return;

    fetch(`/food-items/${foodItemId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Food item deleted successfully!');
                window.location.reload();
            } else {
                alert('Failed to delete food item.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
}
