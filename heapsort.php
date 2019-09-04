<?php
function heapify(&$arr, $n, $i)
{
    $largest = $i;
    $left = 2 * $i + 1;
    $right = 2 * $i + 2;

    varInspect("heapify(): Begin", $arr, $n, $i);
    echo "largest = $largest   left = $left   right = $right" . PHP_EOL;
    // if left child is larger than root
    if (($left < $n) && $arr[$left] > $arr[$largest])
    {
      $largest = $left;
      echo "heapify(): FIRST comparison true. largest = $largest" . PHP_EOL;
    }


    // if right child is larger than largest so far
    if (($right < $n) && $arr[$right] > $arr[$largest])
    {
      $largest = $right;
      echo "heapify(): SECOND comparison true. largest = $largest" . PHP_EOL;
    }

    // if largest is not root
    if ($largest != $i)
    {
        varInspect("heapify(): Before swap", $arr, $n, $i);
        $temp = $arr[$i];
        $arr[$i] = $arr[$largest];
        $arr[$largest] = $temp;
        varInspect("heapify(): After swap", $arr, $n, $i);

        // recursively heapify the affected sub-tree
        echo "Calling heapify() arr, $n, $largest" . PHP_EOL;
        heapify($arr, $n, $largest);
    } else {
      echo "heapify(): No swap made" . PHP_EOL;
    }
}

function varInspect($location, $arr, $n, $i) {
  echo "IN $location." . PHP_EOL;
  echo "i = $i   n = $n" . PHP_EOL;
  echo "arr = [";
  for ($x = 0; $x < $n; $x++)
    echo $arr[$x] . ",";
  echo "]" . PHP_EOL;
}

function heapSort(&$arr, $n)
{
    // build heap (rearrange array)
    for ($i = $n / 2 - 1; $i >= 0; $i--)
    {

      varInspect("heapSort(): first loop", $arr, $n, $i);
      echo "Call to heapify(arr, n, i)" . PHP_EOL;
      heapify($arr, $n, $i);
    }

    // one by one extract an element from heap
    for ($i = $n-1; $i >= 0; $i--)
    {
        // move current root to end
        // swap(arr[0], arr[i]);
        varInspect("heapSort(): second loop, before swap", $arr, $n, $i);
        $temp = $arr[0];
        $arr[0] = $arr[$i];
        $arr[$i] = $temp;
        varInspect("heapSort(): second loop, after swap", $arr, $n, $i);

        // call max heapify on the reduced heap
        echo "Call to heapify(arr, i, 0)" . PHP_EOL;
        heapify($arr, $i, 0);
    }
}



$arr = [121, 10, 130, 57, 36, 17];
$n = sizeof($arr);

heapSort($arr, $n);

echo "Sorted array is " . PHP_EOL;
echo var_export($arr, true);


?>
