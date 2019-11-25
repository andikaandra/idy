{% extends 'layout.volt' %}

{% block title %}Home{% endblock %}

{% block styles %}
    <style>
        *{
            margin:0;
            padding:0;
        }
        body{
            font-family:arial,sans-serif;
            font-size:100%;
            margin:3em;
            background:#666;
            color:#fff;
        }
        h2,p{
            font-size:100%;
            font-weight:normal;
            color: black;
        }
        ul,li{
            list-style:none;
        }
        ul{
            overflow:hidden;
            padding:3em;
        }
        ul li .sticky {
            text-decoration:none;
            color:#000;
            background:#f6ff7a;
            display:block;
            height:15em;
            width:15em;
            padding:1em;
            -moz-box-shadow:5px 5px 7px rgba(33,33,33,1);
            /* Safari+Chrome */
            -webkit-box-shadow: 5px 5px 7px rgba(33,33,33,.7);
            /* Opera */
            box-shadow: 5px 5px 7px rgba(33,33,33,.7);
            transition:-moz-transform .15s linear;
            -moz-transition:-moz-transform .15s linear;
            -o-transition:-o-transform .15s linear;
            -webkit-transition:-webkit-transform .15s linear;
        }
        ul li{
            margin:1em;
            float:left;
        }
        ul li h2{
            font-size:140%;
            font-weight:bold;
            padding-bottom:10px;
        }
        ul li p{
            font-family:"Reenie Beanie",arial,sans-serif;
        }
        ul li:nth-child(even) .sticky {
            transform:rotate(4deg);
            -o-transform:rotate(4deg);
            -webkit-transform:rotate(4deg);
            -moz-transform:rotate(4deg);
            position:relative;
            top:5px;
        }
        ul li:nth-child(3n) .sticky {
            transform:rotate(-3deg);
            -o-transform:rotate(-3deg);
            -webkit-transform:rotate(-3deg);
            -moz-transform:rotate(-3deg);
            position:relative;
            top:-5px;
            background:#f26b6b;
        }
        ul li:nth-child(5n) .sticky {
            transform:rotate(5deg);
            -o-transform:rotate(5deg);
            -webkit-transform:rotate(5deg);
            -moz-transform:rotate(5deg);
            position:relative;
            top:-10px;
            background: #6bbcf2;
        }
        ul li .sticky:hover,ul li .sticky:focus{
            -moz-box-shadow:10px 10px 7px rgba(0,0,0,.7);
            -webkit-box-shadow: 10px 10px 7px rgba(0,0,0,.7);
            box-shadow:10px 10px 7px rgba(0,0,0,.7);
            transform: scale(1.25);
            -webkit-transform: scale(1.25);
            -moz-transform: scale(1.25);
            -o-transform: scale(1.25);
            position:relative;
            z-index:5;
        }
    </style>

{% endblock %}

{% block content %}

    <ul>
        {% for idea in ideas %}
            <li>
                <div class="sticky">
                    <h2>{{ idea.title() }}</h2>
                    <p>{{ idea.description() }}</p>
                    <div class="author"><small>By {{ idea.author().name() }}</small></div>
                    <div class="email"><small>{{ idea.author().email() }}</small></div>
                    <div class="email">
                        <small>Ratings: {{ idea.averageRating() }}</small>
                        <button type="button" class="btn btn-sm btn-outline-primary" id="btn-modal" data-toggle="modal" data-target="#exampleModal" data-idea-id="{{idea.id().id()}}" data-idea-title="{{ idea.title() }}">Rate</button>
                    </div>
                    <form action="{{ url('idea/vote') }}" method="POST">
                        <input type="hidden" value="{{idea.id().id()}}" name="idea_id_vote">
                        <div class="rating"><small>Votes: {{ idea.votes() }}</small> <button type="submit" class="btn btn-sm btn-outline-primary">Vote</button></div>
                    </form>
                </div>
            </li>
        {% endfor  %}
    </ul> 
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="color:black">Rate Idea</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('idea/rate') }}" method="POST">
                    <div class="modal-body">
                        <h5 style="color:black">Rate <span id="idea_title"></span></h5>
                        <input type="hidden" value="" name="idea_id_rate" id="idea_id_rate">
                        <input type="number" min="1" max="5" class="form-control form-control-sm" id="rate" name="rate" placeholder="Enter rating" required><br>
                        <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Enter name" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Rate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
{% endblock %}

{% block scripts %}
<!-- idea_title -->
<script>
    $(document).on("click", "#btn-modal", function(event){
        idea_id = $(this).data('idea-id');
        idea_title = $(this).data('idea-title');
        $('#idea_title').html(idea_title);
        $('#idea_id_rate').val(idea_id);
    });
</script>
{% endblock %}