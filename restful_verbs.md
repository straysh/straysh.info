			 
	Verb	        Path	                Action	RouteName		
    GET	        /photo	                index   photo.index
    GET	        /photo/create	        create	photo.create
    POST	        /photo	                store   photo.store
    GET	        /photo/{photo}	        show	photo.show
    GET	        /photo/{photo}/edit	edit	photo.edit
    PUT/PATCH	/photo/{photo}	        update	photo.update
    DELETE	        /photo/{photo}	        destroy	photo.destroy

<table>
    <tr><th>Verb</th> <th>Path</th> <th>Action</th> <th>Route Name</th></tr>
    <tr><td>GET</td> <td>/photo</td> <td>index</td> <td>photo.index</td> <td></td> <td></td> <td></td></tr>
    <tr><td>GET</td> <td>/photo/create</td> <td>create</td> <td>photo.create</td> <td></td> <td></td> <td></td></tr>
    <tr><td>POST</td> <td>/photo</td> <td>store</td> <td>photo.store</td> <td></td> <td></td> <td></td></tr>
    <tr><td>GET</td> <td>/photo/{photo}</td> <td>show</td> <td>photo.show</td> <td></td> <td></td> <td></td></tr>
    <tr><td>GET</td> <td>/photo/{photo}/edit</td> <td>edit</td> <td>photo.edit</td> <td></td> <td></td> <td></td></tr>
    <tr><td>PUT/PATCH</td> <td>/photo/{photo}</td> <td>update</td> <td>photo.update</td> <td></td> <td></td> <td></td></tr>
    <tr><td>DELETE</td> <td>/photo/{photo}</td> <td>destroy</td> <td>photo.destroy</td> <td></td> <td></td> <td></td></tr>
</table>