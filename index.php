<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  
<header class='flex shadow-md py-4 px-4 sm:px-10 bg-white font-[sans-serif] min-h-[70px] tracking-wide relative z-50'>
  <div class='flex flex-wrap items-center justify-between gap-5 w-full'>
    
      <h1 class="text-3xl p-3 font-bold mb-2 text-gray-800">ServiceDesk</h1>
    </a>

    <div id="collapseMenu"
      class='max-lg:hidden lg:!block max-lg:before:fixed max-lg:before:bg-black max-lg:before:opacity-50 max-lg:before:inset-0 max-lg:before:z-50'>
      <button id="toggleClose" class='lg:hidden fixed top-2 right-4 z-[100] rounded-full bg-white p-3'>
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 fill-black" viewBox="0 0 320.591 320.591">
          <path
            d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
            data-original="#000000"></path>
          <path
            d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
            data-original="#000000"></path>
        </svg>
      </button>

      <ul
        class='lg:flex gap-x-5 max-lg:space-y-3 max-lg:fixed max-lg:bg-white max-lg:w-1/2 max-lg:min-w-[300px] max-lg:top-0 max-lg:left-0 max-lg:p-6 max-lg:h-full max-lg:shadow-md max-lg:overflow-auto z-50'>
        <li class='mb-6 hidden max-lg:block'>
          <a href="javascript:void(0)"><img src="https://readymadeui.com/readymadeui.svg" alt="logo" class='w-36' />
          </a>
        </li>
<!--         <li class='max-lg:border-b border-gray-300 max-lg:py-3 px-3'>
          <a href='javascript:void(0)'
            class='hover:text-[#007bff] text-[#007bff] block font-semibold text-[15px]'>Home</a>
        </li>
        <li class='max-lg:border-b border-gray-300 max-lg:py-3 px-3'><a href='about.php'
            class='hover:text-[#007bff] text-gray-500 block font-semibold text-[15px]'>About</a>
        </li>
        <li class='max-lg:border-b border-gray-300 max-lg:py-3 px-3'><a href='javascript:void(0)'
            class='hover:text-[#007bff] text-gray-500 block font-semibold text-[15px]'>Contact</a>
        </li> -->
      </ul>
    </div>

    <div class='flex max-lg:ml-auto space-x-3'>


      <button id="toggleOpen" class='lg:hidden'>
        <svg class="w-7 h-7" fill="#000" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd"
            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
            clip-rule="evenodd"></path>
        </svg>
      </button>

    </div>
  </div>
</header>

<main>
    <div class="flex justify-between items-center">
      <h1 class="text-3xl p-3 font-bold mb-2 text-gray-800">Tickets</h1>
    <form method="GET" action="ticket.php">
      <button type="submit" class="bg-yellow-500 hover:bg-blue-700 text-white font-bold py-1.5 px-4 rounded mt-2 mr-10">Create</button>
    </form>
    </div>
<?php
// connect to DB
include 'Database.php'; 

// get data and print out
$query = "SELECT t1.id,
                 t1.title, 
                 t1.description, 
                 s2.status 
          FROM tickets t1
          INNER JOIN status s2 on t1.status_id = s2.id";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        
      echo '<div class="p-10 bg-blue-100">';
      echo '  <div class="bg-white p-6 rounded-lg shadow-lg">';

      echo '    <div class="flex justify-between items-center">';
      echo '      <h2 class="text-2xl font-bold text-gray-800">' . htmlspecialchars($row["title"]) . '</h2>';

      echo '      <p class="text-green-700 bg-blue-100 p-2 rounded-lg">' . htmlspecialchars($row["status"]) . '</p>'; 
      echo '    </div>';

      echo '    <p class="text-gray-700 mt-4">' . htmlspecialchars($row["description"]) . '</p>'; 

      echo ' <div class="flex justify-between items-center">';
      echo '    <form method="GET" action="ticket.php">';
      echo '      <input type="hidden" name="ticket_id" value="' . htmlspecialchars($row["id"]) . '">';
      echo '      <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1.5 px-4 rounded mt-2">Edit</button>';
      echo '    </form>';
      echo '    <form method="POST" action="delete_ticket.php">';
      echo '      <input type="hidden" name="ticket_id" value="' . htmlspecialchars($row["id"]) . '">';
      echo '      <button type="submit" class="bg-red-500 hover:bg-blue-700 text-white font-bold py-1.5 px-4 rounded mt-2">Delete</button>';
      echo '    </form>';
      echo '  </div>';
      echo '  </div>';
      echo '</div>';
    }
} else {
    echo "No data found.";
}
$conn->close();
?>


</main>

</body>
</html>