<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Report Employee - {{ $data->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>
<style>
    /** Define the margins of your page **/
    @page {
        margin: 100px 25px;
    }

    #customers {
        border-collapse: collapse;
        width: 100%;
        margin-top: 45px;
    }

    #customers td,
    #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #customers tr:hover {
        background-color: #ddd;
    }

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
    }

    header {
        position: fixed;
        top: -60px;
        left: 0px;
        right: 0px;
        height: 90px;

        /** Extra personal styles **/
        background-color: #03a9f4;
        color: white;
        text-align: center;
        line-height: 35px;
    }

    footer {
        position: fixed;
        bottom: -60px;
        left: 0px;
        right: 0px;
        height: 50px;

        /** Extra personal styles **/
        background-color: #03a9f4;
        color: white;
        text-align: center;
        line-height: 35px;
    }
</style>

<body>
    <!-- Define header and footer blocks before your content -->
    <header>
        <h3 class="mt-3 mb-0">COMPANY REPORT EMPLOYE</h3>
        <p class="mt-0">{{ $data->name }}</p>
    </header>

    <!-- Wrap the content of your PDF inside a main tag -->
    <main>
        <table id="customers">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Balance</th>
            </tr>
            @forelse ($data->employee as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td class="text-muted">
                        {{ $item->email }}
                    </td>
                    <td class="text-muted">
                        Rp {{ number_format($item->balance) }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Not Found</td>
                </tr>
            @endforelse
        </table>
    </main>

    <footer>
        Copyright &copy; <?php echo date('Y'); ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous">
    </script>
</body>

</html>
