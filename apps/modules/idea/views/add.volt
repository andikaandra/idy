{% extends 'layout.volt' %}

{% block title %}Add New Idea{% endblock %}

{% block styles %}

{% endblock %}

{% block content %}
<br><br><br>
<p><?php $this->flashSession->output() ?></p>
<div class="card">
    <div class="card-header">
        <h5>Add a new idea</h5>
    </div>
    <div class="card-body">
        <form action="{{url('idea/add')}}" method="POST">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control form-control-sm" id="title" name="title" aria-describedby="titlHelp" placeholder="Enter title" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3" placeholder="Describe your idea"></textarea>
            </div>
            <div class="form-group">
                <label for="title">Author Name</label>
                <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Enter author name" required>
            </div>
            <div class="form-group">
                <label for="title">Author Email</label>
                <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="Enter author email" required>
            </div>
            <a href="{{url('')}}" role="button" class="btn btn-secondary btn-sm">Back</a>&emsp;<button type="submit" class="btn btn-primary btn-sm">Submit</button>
        </form>

    </div>
</div>

{% endblock %}

{% block scripts %}

{% endblock %}