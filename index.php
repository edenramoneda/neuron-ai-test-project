<?php 

  use NeuronAI\Chat\Messages\UserMessage;

  require "./jp_translation.php";
  require "./vendor/autoload.php";

  session_start();

   $translation = '';
   $error = '';
   $inputText = '';



  // Handle form submission
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['text_input'])) {



      try {
          $inputText = trim($_POST['text_input']);
          
          // Create translation agent instance
          $agent = JPTranslation::make();
          $response = $agent->chat(
              new UserMessage($inputText)
          );
          
          // Get the translation content
          $_SESSION['input_text'] = $inputText;
          $_SESSION['translation'] = $response->getContent();
          $_SESSION['error'] = '';
          
      } catch (Exception $e) {
          $_SESSION['error'] = 'Translation failed: ' . $e->getMessage();
      }

      header('Location: ' . $_SERVER['PHP_SELF']);
      exit;

     

  }
   // Get data from session
   $inputText = $_SESSION['input_text'] ?? '';
   $translation = $_SESSION['translation'] ?? '';
   $error = $_SESSION['error'] ?? '';

    function formatText($content){
      $items = array_filter(explode('*', $content), 'trim');


      $fixedFormat = "<ul class='pl-3 list-disc'>\n";
      foreach ($items as $item) {
          $item = trim($item); // Remove extra whitespace
          if (!empty($item)) {
              $fixedFormat .= "    <li>" . htmlspecialchars($item) . "</li>\n";
          }
      }
      $fixedFormat .= "</ul>";

      return $fixedFormat;
    }
   session_unset();



?>
<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style>
       .bg-circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(70px);
            opacity: 0.15;
            z-index: 0;
        }

        .circle-1 {
            width: 400px;
            height: 400px;
            background-color: #ff3860;
            top: -100px;
            left: -100px;
        }

        .circle-2 {
            width: 350px;
            height: 350px;
            background-color: #3860ff;
            bottom: -50px;
            right: -50px;
        }

        .circle-3 {
            width: 300px;
            height: 300px;
            background-color: #60ff38;
            top: 40%;
            left: 60%;
        }
      </style>
  </head>
  <body class="relative min-h-screen bg-[#0b0f1a] text-white">
    <!-- Bottom Gradient Line -->
    <div class="bg-circle circle-1"></div>
    <div class="bg-circle circle-2"></div>
    <div class="bg-circle circle-3"></div>

    <!-- Main Content -->
    <div class="relative z-20 flex flex-col items-center justify-center min-h-screen px-4 text-center">
  
      <!-- Title -->
      <img src="doraemon.png" class="w-48 h-28"/>
        <p class="text-gray-400 mb-8 text-xl font-semibold">
            Translate to Japanese<br>
            <span class="mt-3 text-gray-400 text-sm">
                This is a very simple translation app built with Neuron AI using one of the Gemini model gemini-2.5-flash as I 
                explore the LLMs and ADKs.
            </span><br>
            <span class="mt-3 text-gray-400 text-sm">
              The translation provides natural Japanese in both spoken and written forms, along with a breakdown of the meaning of each word.
            </span>
        </p>
      
  
      <!-- Form Card -->
      <form method="POST" action.prevent="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="bg-gray-900 bg-opacity-80 backdrop-blur-sm p-8 rounded-lg shadow-lg border border-gray-800 
        w-full max-w-2xl">
          <h2 class="text-white text-lg font-semibold mb-4">Please enter the text to translate </h2>
          <input
            type="text"
            name="text_input"
            placeholder="Example: How's your day?"
            class="w-full px-4 py-2 rounded bg-[#1a1f2c] text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4"
          />
          <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
            Translate
          </button>
          </form>
      
          <?php if ($inputText && $translation): ?>

            <div class="response mt-8 text-left text-neutral bg-gray-800 p-3">
              <div class="font-semibold">Words to translate</div>
              <span class="text-neutral"><?php echo $inputText; ?></span>
            </div>

            <div class="response mt-8 text-left text-neutral bg-gray-800 p-3">
              <span class="text-neutral">

                  <?php
                    echo formatText($translation)
                  ?>

              </span>
            </div>
          <?php endif; ?>

          <?php if ($error): ?>
          <!-- Error Message -->
          <div class="response mt-8 text-left">
              <div class="bg-red-900 bg-opacity-50 p-6 rounded-lg border border-red-700">
                  <h3 class="text-red-300 font-semibold mb-2">Error:</h3>
                  <p class="text-red-200"><?php echo htmlspecialchars($error, ENT_QUOTES); ?></p>
              </div>
          </div>
          <?php endif; ?>
        </div>

  
      <!-- Footer nav -->
     
    </div>
  </body>
</html>