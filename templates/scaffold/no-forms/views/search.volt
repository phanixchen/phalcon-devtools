<div class="bg-light clearfix">
    <nav>
        <div class="previous float-left">{{ link_to(router.getControllerName() ~ "/index", "Go Back", "class": "btn btn-secondary") }}</div>
        <div class="next float-right">{{ link_to(router.getControllerName() ~ "/new", "Create $plural$", "class": "btn btn-secondary") }}</div>
    </nav>
</div>
<div class="page-header">
    <h1>{{viewName}} - Search result</h1>
</div>

{{ content() }}
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function(event)
{ 
    
});

/*
$("#dtHorizontalVerticalExample_wrapper").ready(function(){
    // do things after data are loaded to table
});
*/
</script>
<div class="row">
    <table class="table table-bordered">
        <thead>
            <tr>
    $headerColumns$
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        {% if page.items is defined %}
        {% for $singularVar$ in page.items %}
            <tr>
    $rowColumns$
                <td>{{ link_to("$plural$/edit/"~$singularVar$.$pk$, "Edit") }}</td>
                <td>{{ link_to("$plural$/delete/"~$singularVar$.$pk$, "Delete", "onclick":"return confirm('Are you sure?')") }}</td>
            </tr>
        {% endfor %}
        {% endif %}
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-sm-1">
        <p class="pagination" style="line-height: 1.42857;padding: 6px 12px;">
            {{ page.current~"/"~page.total_pages }}
        </p>
    </div>
    <div class="col-sm-8">
        <nav>
            <ul class="pagination">
                <li>{{ link_to("$plural$/search", "First", false, "class": "page-link") }}</li>
                <li>{{ link_to("$plural$/search?page="~page.before, "Previous", false, "class": "page-link") }}</li>
                <li>{{ link_to("$plural$/search?page="~page.next, "Next", false, "class": "page-link") }}</li>
                <li>{{ link_to("$plural$/search?page="~page.last, "Last", false, "class": "page-link") }}</li>
            </ul>
        </nav>
    </div>
    <div class="col-sm-3">
        <p class="pagination" style="line-height: 1.42857;padding: 6px 12px;">
            Total count: {% if page.items is defined %}
                {{ page.total_items }}
            {%endif%}
        </p>
    </div>
</div>


<!-- load all data in table with search and filter and auto-paging
<div class="row">
    <table id="dtHorizontalVerticalExample" class="table table-striped table-bordered table-sm " cellspacing="0" width="100%">
        <thead>
            <tr>
                $headerColumns$
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        {% if page.items is defined %}
        {% for $singularVar$ in page.items %}
            <tr>
    $rowColumns$
                <td>{{ link_to("$plural$/edit/"~$singularVar$.$pk$, "Edit") }}</td>
                <td>{{ link_to("$plural$/delete/"~$singularVar$.$pk$, "Delete", "onclick":"return confirm('Are you sure?')") }}</td>
            </tr>
        {% endfor %}
        {% endif %}
        </tbody>
    </table>
</div>
-->
