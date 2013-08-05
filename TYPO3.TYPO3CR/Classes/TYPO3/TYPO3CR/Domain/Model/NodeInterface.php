<?php
namespace TYPO3\TYPO3CR\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "TYPO3CR".               *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU General Public License, either version 3 of the   *
 * License, or (at your option) any later version.                        *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

/**
 * Interface for a Node
 *
 * @api
 */
interface NodeInterface {

	/**
	 * Regex pattern which matches a node path without any context information
	 */
	const MATCH_PATTERN_PATH = '/^(\/|(?:\/[a-z0-9\-]+)+)$/i';

	/**
	 * Regex pattern which matches a "context path", ie. a node path possibly containing context information such as the
	 * workspace name. This pattern is used at least in the route part handler.
	 */
	const MATCH_PATTERN_CONTEXTPATH = '/^(?P<NodePath>(?:\/?[a-z0-9\-]+)(?:\/[a-z0-9\-]+)*)?(?:@(?P<WorkspaceName>[a-z0-9\-]+))?$/i';

	/**
	 * Maximum number of characters to allow / use for a "label" of a Node
	 */
	const LABEL_MAXIMUM_CHARACTERS = 30;

	/**
	 * Regex pattern which matches a Node Name (ie. segment of a node path)
	 */
	const MATCH_PATTERN_NAME = '/^[a-z0-9\-]+$/i';

	/**
	 * Set the name of the node to $newName, keeping it's position as it is
	 *
	 * @param string $newName
	 * @return void
	 * @throws \InvalidArgumentException if $newName is invalid
	 * @api
	 */
	public function setName($newName);

	/**
	 * Returns the name of this node
	 *
	 * @return string
	 * @api
	 */
	public function getName();

	/**
	 * Returns an up to LABEL_MAXIMUM_LENGTH characters long plain text description of this node
	 *
	 * @return string
	 * @api
	 */
	public function getLabel();

	/**
	 * Returns a short abstract describing / containing summarized content of this node
	 *
	 * @return string
	 * @api
	 */
	public function getAbstract();

	/**
	 * Sets the specified property.
	 *
	 * If the node has a content object attached, the property will be set there
	 * if it is settable.
	 *
	 * @param string $propertyName Name of the property
	 * @param mixed $value Value of the property
	 * @return void
	 * @api
	 */
	public function setProperty($propertyName, $value);

	/**
	 * If this node has a property with the given name.
	 *
	 * If the node has a content object attached, the property will be checked
	 * there.
	 *
	 * @param string $propertyName Name of the property to test for
	 * @return boolean
	 * @api
	 */
	public function hasProperty($propertyName);

	/**
	 * Returns the specified property.
	 *
	 * If the node has a content object attached, the property will be fetched
	 * there if it is gettable.
	 *
	 * @param string $propertyName Name of the property
	 * @return mixed value of the property
	 * @throws \TYPO3\TYPO3CR\Exception\NodeException if the node does not contain the specified property
	 * @api
	 */
	public function getProperty($propertyName);

	/**
	 * Removes the specified property.
	 *
	 * If the node has a content object attached, the property will not be removed on
	 * that object if it exists.
	 *
	 * @param string $propertyName Name of the property
	 * @return void
	 * @throws \TYPO3\TYPO3CR\Exception\NodeException if the node does not contain the specified property
	 * @api
	 */
	public function removeProperty($propertyName);

	/**
	 * Returns all properties of this node.
	 *
	 * If the node has a content object attached, the properties will be fetched
	 * there.
	 *
	 * @return array Property values, indexed by their name
	 * @api
	 */
	public function getProperties();

	/**
	 * Returns the names of all properties of this node.
	 *
	 * @return array Property names
	 * @api
	 */
	public function getPropertyNames();

	/**
	 * Sets a content object for this node.
	 *
	 * @param object $contentObject The content object
	 * @return void
	 * @throws \InvalidArgumentException if the given contentObject is no object.
	 * @api
	 */
	public function setContentObject($contentObject);

	/**
	 * Returns the content object of this node (if any).
	 *
	 * @return object The content object or NULL if none was set
	 * @api
	 */
	public function getContentObject();

	/**
	 * Unsets the content object of this node.
	 *
	 * @return void
	 * @api
	 */
	public function unsetContentObject();

	/**
	 * Sets the node type of this node.
	 *
	 * @param \TYPO3\TYPO3CR\Domain\Model\NodeType $nodeType
	 * @return void
	 * @api
	 */
	public function setNodeType(NodeType $nodeType);

	/**
	 * Returns the node type of this node.
	 *
	 * @return \TYPO3\TYPO3CR\Domain\Model\NodeType
	 * @api
	 */
	public function getNodeType();

	/**
	 * Sets the "hidden" flag for this node.
	 *
	 * @param boolean $hidden If TRUE, this Node will be hidden
	 * @return void
	 * @api
	 */
	public function setHidden($hidden);

	/**
	 * Returns the current state of the hidden flag
	 *
	 * @return boolean
	 * @api
	 */
	public function isHidden();

	/**
	 * Sets the date and time when this node becomes potentially visible.
	 *
	 * @param \DateTime $dateTime Date before this node should be hidden
	 * @return void
	 * @api
	 */
	public function setHiddenBeforeDateTime(\DateTime $dateTime = NULL);

	/**
	 * Returns the date and time before which this node will be automatically hidden.
	 *
	 * @return \DateTime Date before this node will be hidden
	 * @api
	 */
	public function getHiddenBeforeDateTime();

	/**
	 * Sets the date and time when this node should be automatically hidden
	 *
	 * @param \DateTime $dateTime Date after which this node should be hidden
	 * @return void
	 * @api
	 */
	public function setHiddenAfterDateTime(\DateTime $dateTime = NULL);

	/**
	 * Returns the date and time after which this node will be automatically hidden.
	 *
	 * @return \DateTime Date after which this node will be hidden
	 * @api
	 */
	public function getHiddenAfterDateTime();

	/**
	 * Sets if this node should be hidden in indexes, such as a site navigation.
	 *
	 * @param boolean $hidden TRUE if it should be hidden, otherwise FALSE
	 * @return void
	 * @api
	 */
	public function setHiddenInIndex($hidden);

	/**
	 * If this node should be hidden in indexes
	 *
	 * @return boolean
	 * @api
	 */
	public function isHiddenInIndex();

	/**
	 * Sets the roles which are required to access this node
	 *
	 * @param array $accessRoles
	 * @return void
	 * @api
	 */
	public function setAccessRoles(array $accessRoles);

	/**
	 * Returns the names of defined access roles
	 *
	 * @return array
	 * @api
	 */
	public function getAccessRoles();

	/**
	 * Sets the absolute path of this node
	 *
	 * This method is only for internal use by the content repository. Changing
	 * the path of a node manually may lead to unexpected behavior and bad breath.
	 *
	 * @param string $path
	 * @param boolean $recursive
	 * @return void
	 */
	public function setPath($path, $recursive = TRUE);

	/**
	 * Returns the path of this node
	 *
	 * Example: /sites/mysitecom/homepage/about
	 *
	 * @return string The absolute node path
	 * @api
	 */
	public function getPath();

	/**
	 * Returns the absolute path of this node with additional context information (such as the workspace name).
	 *
	 * Example: /sites/mysitecom/homepage/about@user-admin
	 *
	 * @return string Node path with context information
	 * @api
	 */
	public function getContextPath();

	/**
	 * Returns the level at which this node is located.
	 * Counting starts with 0 for "/", 1 for "/foo", 2 for "/foo/bar" etc.
	 *
	 * @return integer
	 * @api
	 */
	public function getDepth();

	/**
	 * Sets the workspace of this node.
	 *
	 * This method is only for internal use by the content repository. Changing
	 * the workspace of a node manually may lead to unexpected behavior.
	 *
	 * @param \TYPO3\TYPO3CR\Domain\Model\Workspace $workspace
	 * @return void
	 */
	public function setWorkspace(Workspace $workspace);

	/**
	 * Returns the workspace this node is contained in
	 *
	 * @return \TYPO3\TYPO3CR\Domain\Model\Workspace
	 * @api
	 */
	public function getWorkspace();

	/**
	 * Returns the identifier of this node.
	 *
	 * This UUID is not the same as the technical persistence identifier used by
	 * Flow's persistence framework. It is an additional identifier which is unique
	 * within the same workspace and is used for tracking the same node in across
	 * workspaces.
	 *
	 * It is okay and recommended to use this identifier for synchronisation purposes
	 * as it does not change even if all of the nodes content or its path changes.
	 *
	 * @return string the node's UUID
	 * @api
	 */
	public function getIdentifier();

	/**
	 * Sets the index of this node
	 *
	 * This method is for internal use and must only be used by other nodes!
	 *
	 * @param integer $index The new index
	 * @return void
	 */
	public function setIndex($index);

	/**
	 * Returns the index of this node which determines the order among siblings
	 * with the same parent node.
	 *
	 * @return integer
	 */
	public function getIndex();

	/**
	 * Returns the parent node of this node
	 *
	 * @return NodeInterface The parent node or NULL if this is the root node
	 * @api
	 */
	public function getParent();

	/**
	 * Returns the parent node path
	 *
	 * @return string Absolute node path of the parent node
	 * @api
	 */
	public function getParentPath();

	/**
	 * Returns the closest ancestor of this node that matches the $nodeTypeFilter
	 *
	 * @param string $nodeTypeFilter  filter for the type of the nodes, supports complex expressions (e.g. "TYPO3.TYPO3CR:Type1", "!TYPO3.TYPO3CR:Type2,TYPO3.TYPO3CR:Type3" or NULL)
	 * @return NodeInterface The found node or NULL if this is the root node or no matching node was found
	 */
	public function getClosestAncestor($nodeTypeFilter);

	/**
	 * Creates, adds and returns a child node of this node. Also sets default
	 * properties and creates default subnodes.
	 *
	 * @param string $name Name of the new node
	 * @param \TYPO3\TYPO3CR\Domain\Model\NodeType $nodeType Node type of the new node (optional)
	 * @param string $identifier The identifier of the node, unique within the workspace, optional(!)
	 * @return \TYPO3\TYPO3CR\Domain\Model\Node
	 * @throws \InvalidArgumentException if the node name is not accepted.
	 * @throws \TYPO3\TYPO3CR\Exception\NodeExistsException if a node with this path already exists.
	 * @api
	 */
	public function createNode($name, NodeType $nodeType = NULL, $identifier = NULL);

	/**
	 * Creates, adds and returns a child node of this node, without setting default
	 * properties or creating subnodes.
	 *
	 * For internal use only!
	 *
	 * @param string $name Name of the new node
	 * @param \TYPO3\TYPO3CR\Domain\Model\NodeType $nodeType Node type of the new node (optional)
	 * @param string $identifier The identifier of the node, unique within the workspace, optional(!)
	 * @return \TYPO3\TYPO3CR\Domain\Model\Node
	 * @throws \InvalidArgumentException if the node name is not accepted.
	 * @throws \TYPO3\TYPO3CR\Exception\NodeExistsException if a node with this path already exists.
	 */
	public function createSingleNode($name, NodeType $nodeType = NULL, $identifier = NULL);

	/**
	 * Creates and persists a node from the given $nodeTemplate as child node
	 *
	 * @param \TYPO3\TYPO3CR\Domain\Model\NodeTemplate $nodeTemplate
	 * @param string $nodeName name of the new node. If not specified the name of the nodeTemplate will be used.
	 * @return NodeInterface the freshly generated node
	 * @api
	 */
	public function createNodeFromTemplate(NodeTemplate $nodeTemplate, $nodeName = NULL);

	/**
	 * Returns a node specified by the given relative path.
	 *
	 * @param string $path Path specifying the node, relative to this node
	 * @return NodeInterface The specified node or NULL if no such node exists
	 * @api
	 */
	public function getNode($path);

	/**
	 * Returns the primary child node of this node.
	 *
	 * Which node acts as a primary child node will in the future depend on the
	 * node type. For now it is just the first child node.
	 *
	 * @return NodeInterface The primary child node or NULL if no such node exists
	 * @api
	 */
	public function getPrimaryChildNode();

	/**
	 * Returns all direct child nodes of this node.
	 * If a node type is specified, only nodes of that type are returned.
	 *
	 * @param string $nodeTypeFilter If specified, only nodes with that node type are considered
	 * @param integer $limit An optional limit for the number of nodes to find. Added or removed nodes can still change the number nodes!
	 * @param integer $offset An optional offset for the query
	 * @return array<\TYPO3\TYPO3CR\Domain\Model\NodeInterface> An array of nodes or an empty array if no child nodes matched
	 * @api
	 */
	public function getChildNodes($nodeTypeFilter = NULL, $limit = NULL, $offset = NULL);

	/**
	 * Checks if this node has any child nodes.
	 *
	 * @param string $nodeTypeFilter If specified, only nodes with that node type are considered
	 * @return boolean TRUE if this node has child nodes, otherwise FALSE
	 * @api
	 */
	public function hasChildNodes($nodeTypeFilter = NULL);

	/**
	 * Removes this node and all its child nodes.
	 *
	 * @return void
	 * @api
	 */
	public function remove();

	/**
	 * Enables using the remove method when only setters are available.
	 *
	 * @param boolean $removed If TRUE, this node and it's child nodes will be removed. Cannot handle FALSE (yet).
	 * @return void
	 * @api
	 */
	public function setRemoved($removed);

	/**
	 * If this node is a removed node.
	 *
	 * @return boolean
	 * @api
	 */
	public function isRemoved();

	/**
	 * Tells if this node is "visible".
	 * For this the "hidden" flag and the "hiddenBeforeDateTime" and "hiddenAfterDateTime" dates are
	 * taken into account.
	 *
	 * @return boolean
	 * @api
	 */
	public function isVisible();

	/**
	 * Tells if this node may be accessed according to the current security context.
	 *
	 * @return boolean
	 * @api
	 */
	public function isAccessible();

	/**
	 * Tells if a node, in general,  has access restrictions, independent of the
	 * current security context.
	 *
	 * @return boolean
	 * @api
	 */
	public function hasAccessRestrictions();

	/**
	 * Moves this node before the given node
	 *
	 * @param NodeInterface $referenceNode
	 * @return void
	 * @api
	 */
	public function moveBefore(NodeInterface $referenceNode);

	/**
	 * Moves this node after the given node
	 *
	 * @param NodeInterface $referenceNode
	 * @return void
	 * @api
	 */
	public function moveAfter(NodeInterface $referenceNode);

	/**
	 * Moves this node into the given node
	 *
	 * @param NodeInterface $referenceNode
	 * @return void
	 * @api
	 */
	public function moveInto(NodeInterface $referenceNode);

	/**
	 * Copies this node before the given node
	 *
	 * @param NodeInterface $referenceNode
	 * @param string $nodeName
	 * @return NodeInterface
	 * @throws \TYPO3\TYPO3CR\Exception\NodeExistsException
	 * @api
	 */
	public function copyBefore(NodeInterface $referenceNode, $nodeName);

	/**
	 * Copies this node after the given node
	 *
	 * @param NodeInterface $referenceNode
	 * @param string $nodeName
	 * @return NodeInterface
	 * @throws \TYPO3\TYPO3CR\Exception\NodeExistsException
	 * @api
	 */
	public function copyAfter(NodeInterface $referenceNode, $nodeName);

	/**
	 * Copies this node to below the given node. The new node will be added behind
	 * any existing sub nodes of the given node.
	 *
	 * @param NodeInterface $referenceNode
	 * @param string $nodeName
	 * @return NodeInterface
	 * @throws \TYPO3\TYPO3CR\Exception\NodeExistsException
	 * @api
	 */
	public function copyInto(NodeInterface $referenceNode, $nodeName);

	/**
	 * Return the NodeData representation of the node.
	 *
	 * @return \TYPO3\TYPO3CR\Domain\Model\NodeData
	 */
	public function getNodeData();

	/**
	 * Return the context of the node
	 *
	 * @return \TYPO3\TYPO3CR\Domain\Service\ContextInterface
	 */
	public function getContext();

}
?>