<div class="bg-light clearfix">
    <nav>
        <div class="previous float-left">{{ link_to(router.getControllerName() ~ "/index", "Go Back", "class": "btn btn-secondary") }}</div>
    </nav>
</div>
<div class="page-header">
    <h1>
        {{viewName}} - Edit $plural$
    </h1>
</div>

{{ content() }}
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function(event)
{ 
    
});
</script>
{{ form("$plural$/save", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

$captureFields$
{{ hidden_field("id") }}

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Send', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
