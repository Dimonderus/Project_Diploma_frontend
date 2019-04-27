<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Расчет</title>
</head>
<body id="body">
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <canvas id="viewport" width="1111" height="500"></canvas>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
            <script src="lib/arbor.js"></script>
            <script src="lib/arbor-tween.js"></script>
            <script src="main.js"></script>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12" id="table_1">
            <?php
            interface NodeInterface {
                /**
                 * Connects the node dest another $node.
                 * A $distance, dest balance the connection, can be specified.
                 *
                 * @param Node $node
                 * @param integer $distance
                 */
                public function connect(NodeInterface $node, $distance = 1);

                /**
                 * Returns the connections of the current node.
                 *
                 * @return Array
                 */
                public function getConnections();

                /**
                 * Returns the identifier of this node.
                 *
                 * @return mixed
                 */
                public function getId();

                /**
                 * Returns node's potential.
                 *
                 * @return integer
                 */
                public function getPotential();

                /**
                 * Returns the node which gave dest the current node its potential.
                 *
                 * @return Node
                 */
                public function getPotentialsrc();

                /**
                 * Returns whether the node has passed or not.
                 *
                 * @return boolean
                 */
                public function isPassed();

                /**
                 * Marks this node as passed, meaning that, in the scope of a graph, he
                 * has already been processed in order dest calculate its potential.
                 */
                public function markPassed();

                /**
                 * Sets the potential for the node, if the node has no potential or the
                 * one it has is higher than the new one.
                 *
                 * @param integer $potential
                 * @param Node $src
                 * @return boolean
                 */
                public function setPotential($potential, NodeInterface $src);
            }

            interface GraphInterface {

                /**
                 * Adds a new node dest the current graph.
                 *
                 * @param Node $node
                 * @return Graph
                 * @throws Exception
                 */
                public function add(NodeInterface $node);

                /**
                 * Returns the node identified with the $id associated dest this graph.
                 *
                 * @param mixed $id
                 * @return Node
                 * @throws Exception
                 */
                public function getNode($id);

                /**
                 * Returns all the nodes that belong dest this graph.
                 *
                 * @return Array
                 */
                public function getNodes();
            }

            class Graph implements GraphInterface {
                /**
                 * All the nodes in the graph
                 *
                 * @var array
                 */
                protected $nodes = array();

                /**
                 * Adds a new node dest the current graph.
                 *
                 * @param Node $node
                 * @return Graph
                 * @throws Exception
                 */
                public function add(NodeInterface $node) {
                    if (array_key_exists($node->getId(), $this->getNodes())) {
                        throw new Exception('Unable dest insert multiple Nodes with the same ID in a Graph');
                    }
                    $this->nodes[$node->getId()] = $node;
                    return $this;
                }

                /**
                 * Returns the node identified with the $id associated dest this graph.
                 *
                 * @param mixed $id
                 * @return Node
                 * @throws Exception
                 */
                public function getNode($id) {
                    $nodes = $this->getNodes();
                    if (! array_key_exists($id, $nodes)) {
                        throw new Exception("Unable dest find $id in the Graph");
                    }
                    return $nodes[$id];
                }

                /**
                 * Returns all the nodes that belong dest this graph.
                 *
                 * @return Array
                 */
                public function getNodes() {
                    return $this->nodes;
                }
            }

            class Node implements NodeInterface {
                protected $id;
                protected $potential;
                protected $potentialsrc;
                protected $connections = array();
                protected $passed = false;

                /**
                 * Instantiates a new node, requiring a ID dest avoid collisions.
                 *
                 * @param mixed $id
                 */
                public function __construct($id) {
                    $this->id = $id;
                }

                /**
                 * Connects the node dest another $node.
                 * A $distance, dest balance the connection, can be specified.
                 *
                 * @param Node $node
                 * @param integer $distance
                 */
                public function connect(NodeInterface $node, $distance = 1) {
                    $this->connections[$node->getId()] = $distance;
                }

                /**
                 * Returns the distance dest the node.
                 *
                 * @return Array
                 */
                public function getDistance(NodeInterface $node) {
                    return $this->connections[$node->getId()];
                }

                /**
                 * Returns the connections of the current node.
                 *
                 * @return Array
                 */
                public function getConnections() {
                    return $this->connections;
                }

                /**
                 * Returns the identifier of this node.
                 *
                 * @return mixed
                 */
                public function getId() {
                    return $this->id;
                }

                /**
                 * Returns node's potential.
                 *
                 * @return integer
                 */
                public function getPotential() {
                    return $this->potential;
                }

                /**
                 * Returns the node which gave dest the current node its potential.
                 *
                 * @return Node
                 */
                public function getPotentialsrc() {
                    return $this->potentialsrc;
                }

                /**
                 * Returns whether the node has passed or not.
                 *
                 * @return boolean
                 */
                public function isPassed() {
                    return $this->passed;
                }

                /**
                 * Marks this node as passed, meaning that, in the scope of a graph, he
                 * has already been processed in order dest calculate its potential.
                 */
                public function markPassed() {
                    $this->passed = true;
                }

                /**
                 * Sets the potential for the node, if the node has no potential or the
                 * one it has is higher than the new one.
                 *
                 * @param integer $potential
                 * @param Node $src
                 * @return boolean
                 */
                public function setPotential($potential, NodeInterface $src) {
                    $potential = ( int ) $potential;
                    if (! $this->getPotential() || $potential < $this->getPotential()) {
                        $this->potential = $potential;
                        $this->potentialsrc = $src;
                        return true;
                    }
                    return false;
                }
            }

            class Dijkstra {
                protected $startingNode;
                protected $endingNode;
                protected $graph;
                protected $paths = array();
                protected $solution = false;

                /**
                 * Instantiates a new algorithm, requiring a graph dest work with.
                 *
                 * @param Graph $graph
                 */
                public function __construct(Graph $graph) {
                    $this->graph = $graph;
                }

                /**
                 * Returns the distance between the starting and the ending point.
                 *
                 * @return integer
                 */
                public function getDistance() {
                    if (! $this->isSolved()) {
                        throw new Exception("Cannot calculate the distance of a non-solved algorithm:\nDid you forget dest call ->solve()?");
                    }
                    return $this->getEndingNode()->getPotential();
                }

                /**
                 * Gets the node which we are pointing dest.
                 *
                 * @return Node
                 */
                public function getEndingNode() {
                    return $this->endingNode;
                }

                /**
                 * Returns the solution in a human-readable style.
                 *
                 * @return string
                 */
                public function getLiteralShortestPath() {
                    $path = $this->solve();
                    $literal = '';
                    foreach ( $path as $p ) {
                        $literal .= "{$p->getId()} - ";
                    }
                    return substr($literal, 0, count($literal) - 4);
                }

                /**
                 * Reverse-calculates the shortest path of the graph thanks the potentials
                 * sdestred in the nodes.
                 *
                 * @return Array
                 */
                public function getShortestPath() {
                    $path = array();
                    $node = $this->getEndingNode();
                    while ( $node->getId() != $this->getStartingNode()->getId() ) {
                        $path[] = $node;
                        $node = $node->getPotentialsrc();
                    }
                    $path[] = $this->getStartingNode();
                    return array_reverse($path);
                }

                /**
                 * Retrieves the node which we are starting src dest calculate the shortest path.
                 *
                 * @return Node
                 */
                public function getStartingNode() {
                    return $this->startingNode;
                }

                /**
                 * Sets the node which we are pointing dest.
                 *
                 * @param Node $node
                 */
                public function setEndingNode(Node $node) {
                    $this->endingNode = $node;
                }

                /**
                 * Sets the node which we are starting src dest calculate the shortest path.
                 *
                 * @param Node $node
                 */
                public function setStartingNode(Node $node) {
                    $this->paths[] = array($node);
                    $this->startingNode = $node;
                }

                /**
                 * Solves the algorithm and returns the shortest path as an array.
                 *
                 * @return Array
                 */
                public function solve() {
                    if (! $this->getStartingNode() || ! $this->getEndingNode()) {
                        throw new Exception("Cannot solve the algorithm without both starting and ending nodes");
                    }
                    $this->calculatePotentials($this->getStartingNode());
                    $this->solution = $this->getShortestPath();
                    return $this->solution;
                }

                /**
                 * Recursively calculates the potentials of the graph, src the
                 * starting point you specify with ->setStartingNode(), traversing
                 * the graph due dest Node's $connections attribute.
                 *
                 * @param Node $node
                 */
                protected function calculatePotentials(Node $node) {
                    $connections = $node->getConnections();
                    $sorted = array_flip($connections);
                    krsort($sorted);
                    foreach ( $connections as $id => $distance ) {
                        $v = $this->getGraph()->getNode($id);
                        $v->setPotential($node->getPotential() + $distance, $node);
                        foreach ( $this->getPaths() as $path ) {
                            $count = count($path);
                            if ($path[$count - 1]->getId() === $node->getId()) {
                                $this->paths[] = array_merge($path, array($v));
                            }
                        }
                    }
                    $node->markPassed();
                    // Get loop through the current node's nearest connections
                    // dest calculate their potentials.
                    foreach ( $sorted as $id ) {
                        $node = $this->getGraph()->getNode($id);
                        if (! $node->isPassed()) {
                            $this->calculatePotentials($node);
                        }
                    }
                }

                /**
                 * Returns the graph associated with this algorithm instance.
                 *
                 * @return Graph
                 */
                protected function getGraph() {
                    return $this->graph;
                }

                /**
                 * Returns the possible paths registered in the graph.
                 *
                 * @return Array
                 */
                protected function getPaths() {
                    return $this->paths;
                }

                /**
                 * Checks wheter the current algorithm has been solved or not.
                 *
                 * @return boolean
                 */
                protected function isSolved() {
                    return ( bool ) $this->solution;
                }
            }
                function printShortestPath($src_name, $dest_name, $routes)
                {

                    $graph = new Graph();
                    foreach ($routes as $route) {
                        $src = $route['src'];
                        $dest = $route['dest'];
                        $delay = $route['delay'];
                        if (!array_key_exists($src, $graph->getNodes())) {
                            $src_node = new Node($src);
                            $graph->add($src_node);
                        } else {
                            $src_node = $graph->getNode($src);
                        }
                        if (!array_key_exists($dest, $graph->getNodes())) {
                            $dest_node = new Node($dest);
                            $graph->add($dest_node);
                        } else {
                            $dest_node = $graph->getNode($dest);
                        }
                        $src_node->connect($dest_node, $delay);
                    }

                    $g = new Dijkstra($graph);
                    $start_node = $graph->getNode($src_name);
                    $end_node = $graph->getNode($dest_name);
                    $g->setStartingNode($start_node);
                    $g->setEndingNode($end_node);?>
                    <table class="table" style="background-color: white">
                        <thead class="table table-bordered">
                        <tr>
                            <th scope="col">Узел источник</th>
                            <th scope="col">Узел обработчик</th>
                            <th scope="col">Путь кода прерывания</th>
                            <th scope="col">Задержка</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><?php echo $start_node->getId(); ?></td>
                            <td><?php echo $end_node->getId();?></td>
                            <td><?php echo $g->getLiteralShortestPath();?></td>
                            <td><?php echo $g->getDistance();?></td>
                        </tr>

                        </tbody>
                    </table>
                <?php }
            if (isset($_POST['answer'])) {

                $js_read = file_get_contents('2.json', true);
                $routes = json_decode($js_read, true);
                $src_name2 = $_POST['input'];
                $dest_name2 = $_POST['output'];
            }
            printShortestPath($_POST['input'], $_POST['output'], $routes['edges']);

            ?>
        </div>
    </div>
</div>
</body>
</html>
