<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Task</title>
    <style>
        /* Page size and margins for A4 */
        @page {
            size: A4;
            margin: 1cm;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
            padding: 0;
            margin: 0;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        h1, h2 {
            text-align: center;
        }

        .task-header {
            margin-bottom: 20px;
        }

        .task-details, .people-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .task-details th, .people-table th, .task-details td, .people-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .task-details th, .people-table th {
            background-color: #f2f2f2;
        }

        .person-page {
            page-break-before: always;
        }

        /* Ensure print styles fit the page */
        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .container {
                width: 100%;
                padding: 10px;
            }

            /* Add break before every person's section */
            .person-page {
                page-break-before: always;
            }

            /* Make sure last page doesn't have unnecessary breaks */
            .no-page-break {
                page-break-before: auto;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Task Header -->
    <div class="task-header">
        <h1>Task Details</h1>
        <p><strong>Title:</strong> {{ $task->title }}</p>
        <p><strong>Description:</strong> {{ $task->description }}</p>
    </div>

    <!-- People Assigned to This Task (on Page 1) -->
    <h2>People Assigned to This Task</h2>
    <table class="people-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Title</th>
                <th>Job</th>
                <th>Level</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($task->people as $person)
                <tr>
                    <td>{{ $person->name }}</td>
                    <td>{{ $person->title }}</td>
                    <td>{{ $person->job }}</td>
                    <td>{{ $person->level }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Page Break Before Person's Info -->
    @foreach ($task->people as $index => $person)
        <div class="person-page">
            <h2>Person {{ $index + 1 }} Details</h2>
            <p><strong>Name:</strong> {{ $person->name }}</p>
            <p><strong>Title:</strong> {{ $person->title }}</p>
            <p><strong>Job:</strong> {{ $person->job }}</p>
            <p><strong>Level:</strong> {{ $person->level }}</p>
        </div>
    @endforeach
</div>

<script>
    // Automatically trigger print dialog
    window.print();
</script>

</body>
</html>
