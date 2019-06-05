<div class="bg-light clearfix">
    <nav>
        <div class="next float-right">{{ link_to(router.getControllerName() ~ "/new", "Create $plural$", "class": "btn btn-secondary") }}</div>
    </nav>
</div>
<div class="page-header">
    <h1>
        {{viewName}} - Search $plural$
    </h1>
</div>


{{ content() }}
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function(event)
{ 
    
});
</script>
{{ form("$plural$/search", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

$captureFields$
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Search', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
