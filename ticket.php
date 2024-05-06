<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<?php

include 'Database.php'; 

    $id = isset($_GET['ticket_id']) ? (int)$_GET['ticket_id'] : 0; // Ensure ID is an integer
    if ($id != 0) {

        $query = "SELECT t1.id,
                     t1.title, 
                     t1.description, 
                     s2.status 
              FROM tickets t1
              INNER JOIN status s2 on t1.status_id = s2.id";

        $result = $conn->query($query);
        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);   

    }  

    $query1 = "select status
                  from status";
        
    $result1 = $conn->query($query1);
    $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);  

    $form_action = ($id > 0) ? "save_changes.php" : "create_ticket.php";

?>



<nav class="flex p-10" aria-label="Breadcrumb">
  <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
    <li class="inline-flex items-center">
      <a href="index.php" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
        </svg>
        Home
      </a>
    </li>
    <li>
      <div class="flex items-center">
        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
        </svg>
        <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white"><?php echo htmlspecialchars($row["title"]) ?></a>
      </div>
    </li>

  </ol>
</nav>

    <form class="p-10 ticket-form" method="POST" action="<?php echo htmlspecialchars($form_action); ?>">

        <div class="flex flex-wrap -mx-3 mb-6">
            <input type="hidden" name="ticket_id" value="<?php echo htmlspecialchars($id); ?>">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">

                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    Title
                </label>

                <input value="<?php echo htmlspecialchars($row["title"]) ?>" name="title" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-title" type="text" placeholder="ORA-20001 - ...">
                <div class="title-hidden hidden"></div>
            </div>

            <div class="w-full md:w-1/2 px-3">

                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    Description
                </label>

                <textarea value="<?php echo htmlspecialchars($row["description"]) ?>" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-description" name="description"  rows="3">
                     <?php echo htmlspecialchars($row["description"]) ?>
                </textarea>
                <div class="description-hidden hidden"></div>

            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">

            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <div class="relative">

                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-status">
                        Status
                    </label>
                    <select value="<?php echo htmlspecialchars($row["status"]) ?>" name="status" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-status">
                    <?php
                        while($row1 = $result1->fetch_assoc()) {
                            echo '<option>' . htmlspecialchars($row1["status"]) . '</option>';
                        }
                    ?>
                    </select>

                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">

                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                        </svg>

                    </div>

                </div>
            </div>
        </div>
        <br>
        <br>
    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
    <button class="bg-blue-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Close</button>
    </form>
    
    
    <script src="./js/validations.js"></script>
</body>
</html>