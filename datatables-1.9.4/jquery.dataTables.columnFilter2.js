window._site.forumUser = "";
$(document).ready( function () {
	window._site.comments( $('div.content div.comments'), [{"id":"1543","username":"RichApps","comment":"<p>If you use &quot;bStateSave&quot;: true, and you want select dropdown to show proper value after refresh you need to substitute this code:<\/p>\r\n\r\n<pre><code class=\"multiline language-js\">                column.data().unique().sort().each( function ( d, j ) {\r\n                    select.append( '<option value=\"'+d+'\">'+d+'<\/option>' )\r\n                } );\r\n<\/code><\/pre>\r\n\r\n<p>with this:<\/p>\r\n\r\n<pre><code class=\"multiline language-js\">                column.data().unique().sort().each( function ( d, j ) {\r\n                    if(column.search() === '^'+d+'$'){\r\n                        select.append( '<option value=\"'+d+'\" selected=\"selected\">'+d+'<\/option>' )\r\n                    } else {\r\n                        select.append( '<option value=\"'+d+'\">'+d+'<\/option>' )\r\n                    }\r\n                } );\r\n<\/code><\/pre>\r\n","created":"10:03, Mon 4th Jan 2016","parent":null,"version":"1.10.10","children":[]}] );
} );window._site.page = "examples\/api\/multi_filter_select.html";

$(document).ready( function () {
	window._site.dynamicLoaded();
} );
