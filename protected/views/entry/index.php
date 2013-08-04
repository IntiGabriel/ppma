<h2>Entries</h2>

<table id="entry-list" class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Username</th>
            <th>Tags</th>
            <th></th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>


<script id="entry-row-template" type="text/html">
    <td class="id">{{ id }}</td>
    <td class="name">{{ name }}</td>
    <td class="username">{{ username }}</td>
    <td></td>
    <td class="button-column">
        <a href="#delete-{{ id }}" class="delete" rel="{{ id }}"><i class="icon-remove"></i></a>
        <a href="#edit-{{ id }}" class="edit" rel="{{ id }}"><i class="icon-edit"></i></a>
    </td>
</script>