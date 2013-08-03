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
        <script class="record template" type="text/html">
            <tr>
                <td class="id">{{ id }}</td>
                <td>{{ name }}</td>
                <td>{{ username }}</td>
                <td></td>
                <td class="button-column">
                    <a href="#delete-{{ id }}" class="delete" rel="{{ id }}"><i class="icon-remove"></i></a>
                    <a href="#edit-{{ id }}" class="edit" rel="{{ id }}"><i class="icon-edit"></i></a>
                </td>
            </tr>
        </script>
    </tbody>
</table>