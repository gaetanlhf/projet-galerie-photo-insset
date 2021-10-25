<?php

namespace ContainerG7C71OH;
include_once \dirname(__DIR__, 4).'/vendor/doctrine/persistence/lib/Doctrine/Persistence/ObjectManager.php';
include_once \dirname(__DIR__, 4).'/vendor/doctrine/orm/lib/Doctrine/ORM/EntityManagerInterface.php';
include_once \dirname(__DIR__, 4).'/vendor/doctrine/orm/lib/Doctrine/ORM/EntityManager.php';

class EntityManager_9a5be93 extends \Doctrine\ORM\EntityManager implements \ProxyManager\Proxy\VirtualProxyInterface
{
    /**
     * @var \Doctrine\ORM\EntityManager|null wrapped object, if the proxy is initialized
     */
    private $valueHolder81d75 = null;

    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $initializerf9ccf = null;

    /**
     * @var bool[] map of public properties of the parent class
     */
    private static $publicProperties3ddc5 = [
        
    ];

    public function getConnection()
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'getConnection', array(), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->getConnection();
    }

    public function getMetadataFactory()
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'getMetadataFactory', array(), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->getMetadataFactory();
    }

    public function getExpressionBuilder()
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'getExpressionBuilder', array(), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->getExpressionBuilder();
    }

    public function beginTransaction()
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'beginTransaction', array(), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->beginTransaction();
    }

    public function getCache()
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'getCache', array(), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->getCache();
    }

    public function transactional($func)
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'transactional', array('func' => $func), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->transactional($func);
    }

    public function wrapInTransaction(callable $func)
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'wrapInTransaction', array('func' => $func), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->wrapInTransaction($func);
    }

    public function commit()
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'commit', array(), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->commit();
    }

    public function rollback()
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'rollback', array(), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->rollback();
    }

    public function getClassMetadata($className)
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'getClassMetadata', array('className' => $className), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->getClassMetadata($className);
    }

    public function createQuery($dql = '')
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'createQuery', array('dql' => $dql), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->createQuery($dql);
    }

    public function createNamedQuery($name)
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'createNamedQuery', array('name' => $name), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->createNamedQuery($name);
    }

    public function createNativeQuery($sql, \Doctrine\ORM\Query\ResultSetMapping $rsm)
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'createNativeQuery', array('sql' => $sql, 'rsm' => $rsm), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->createNativeQuery($sql, $rsm);
    }

    public function createNamedNativeQuery($name)
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'createNamedNativeQuery', array('name' => $name), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->createNamedNativeQuery($name);
    }

    public function createQueryBuilder()
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'createQueryBuilder', array(), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->createQueryBuilder();
    }

    public function flush($entity = null)
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'flush', array('entity' => $entity), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->flush($entity);
    }

    public function find($className, $id, $lockMode = null, $lockVersion = null)
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'find', array('className' => $className, 'id' => $id, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->find($className, $id, $lockMode, $lockVersion);
    }

    public function getReference($entityName, $id)
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'getReference', array('entityName' => $entityName, 'id' => $id), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->getReference($entityName, $id);
    }

    public function getPartialReference($entityName, $identifier)
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'getPartialReference', array('entityName' => $entityName, 'identifier' => $identifier), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->getPartialReference($entityName, $identifier);
    }

    public function clear($entityName = null)
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'clear', array('entityName' => $entityName), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->clear($entityName);
    }

    public function close()
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'close', array(), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->close();
    }

    public function persist($entity)
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'persist', array('entity' => $entity), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->persist($entity);
    }

    public function remove($entity)
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'remove', array('entity' => $entity), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->remove($entity);
    }

    public function refresh($entity)
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'refresh', array('entity' => $entity), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->refresh($entity);
    }

    public function detach($entity)
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'detach', array('entity' => $entity), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->detach($entity);
    }

    public function merge($entity)
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'merge', array('entity' => $entity), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->merge($entity);
    }

    public function copy($entity, $deep = false)
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'copy', array('entity' => $entity, 'deep' => $deep), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->copy($entity, $deep);
    }

    public function lock($entity, $lockMode, $lockVersion = null)
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'lock', array('entity' => $entity, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->lock($entity, $lockMode, $lockVersion);
    }

    public function getRepository($entityName)
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'getRepository', array('entityName' => $entityName), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->getRepository($entityName);
    }

    public function contains($entity)
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'contains', array('entity' => $entity), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->contains($entity);
    }

    public function getEventManager()
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'getEventManager', array(), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->getEventManager();
    }

    public function getConfiguration()
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'getConfiguration', array(), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->getConfiguration();
    }

    public function isOpen()
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'isOpen', array(), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->isOpen();
    }

    public function getUnitOfWork()
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'getUnitOfWork', array(), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->getUnitOfWork();
    }

    public function getHydrator($hydrationMode)
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'getHydrator', array('hydrationMode' => $hydrationMode), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->getHydrator($hydrationMode);
    }

    public function newHydrator($hydrationMode)
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'newHydrator', array('hydrationMode' => $hydrationMode), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->newHydrator($hydrationMode);
    }

    public function getProxyFactory()
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'getProxyFactory', array(), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->getProxyFactory();
    }

    public function initializeObject($obj)
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'initializeObject', array('obj' => $obj), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->initializeObject($obj);
    }

    public function getFilters()
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'getFilters', array(), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->getFilters();
    }

    public function isFiltersStateClean()
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'isFiltersStateClean', array(), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->isFiltersStateClean();
    }

    public function hasFilters()
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'hasFilters', array(), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return $this->valueHolder81d75->hasFilters();
    }

    /**
     * Constructor for lazy initialization
     *
     * @param \Closure|null $initializer
     */
    public static function staticProxyConstructor($initializer)
    {
        static $reflection;

        $reflection = $reflection ?? new \ReflectionClass(__CLASS__);
        $instance   = $reflection->newInstanceWithoutConstructor();

        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $instance, 'Doctrine\\ORM\\EntityManager')->__invoke($instance);

        $instance->initializerf9ccf = $initializer;

        return $instance;
    }

    protected function __construct(\Doctrine\DBAL\Connection $conn, \Doctrine\ORM\Configuration $config, \Doctrine\Common\EventManager $eventManager)
    {
        static $reflection;

        if (! $this->valueHolder81d75) {
            $reflection = $reflection ?? new \ReflectionClass('Doctrine\\ORM\\EntityManager');
            $this->valueHolder81d75 = $reflection->newInstanceWithoutConstructor();
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);

        }

        $this->valueHolder81d75->__construct($conn, $config, $eventManager);
    }

    public function & __get($name)
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, '__get', ['name' => $name], $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        if (isset(self::$publicProperties3ddc5[$name])) {
            return $this->valueHolder81d75->$name;
        }

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder81d75;

            $backtrace = debug_backtrace(false, 1);
            trigger_error(
                sprintf(
                    'Undefined property: %s::$%s in %s on line %s',
                    $realInstanceReflection->getName(),
                    $name,
                    $backtrace[0]['file'],
                    $backtrace[0]['line']
                ),
                \E_USER_NOTICE
            );
            return $targetObject->$name;
        }

        $targetObject = $this->valueHolder81d75;
        $accessor = function & () use ($targetObject, $name) {
            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __set($name, $value)
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, '__set', array('name' => $name, 'value' => $value), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder81d75;

            $targetObject->$name = $value;

            return $targetObject->$name;
        }

        $targetObject = $this->valueHolder81d75;
        $accessor = function & () use ($targetObject, $name, $value) {
            $targetObject->$name = $value;

            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __isset($name)
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, '__isset', array('name' => $name), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder81d75;

            return isset($targetObject->$name);
        }

        $targetObject = $this->valueHolder81d75;
        $accessor = function () use ($targetObject, $name) {
            return isset($targetObject->$name);
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = $accessor();

        return $returnValue;
    }

    public function __unset($name)
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, '__unset', array('name' => $name), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder81d75;

            unset($targetObject->$name);

            return;
        }

        $targetObject = $this->valueHolder81d75;
        $accessor = function () use ($targetObject, $name) {
            unset($targetObject->$name);

            return;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $accessor();
    }

    public function __clone()
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, '__clone', array(), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        $this->valueHolder81d75 = clone $this->valueHolder81d75;
    }

    public function __sleep()
    {
        $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, '__sleep', array(), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;

        return array('valueHolder81d75');
    }

    public function __wakeup()
    {
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);
    }

    public function setProxyInitializer(\Closure $initializer = null) : void
    {
        $this->initializerf9ccf = $initializer;
    }

    public function getProxyInitializer() : ?\Closure
    {
        return $this->initializerf9ccf;
    }

    public function initializeProxy() : bool
    {
        return $this->initializerf9ccf && ($this->initializerf9ccf->__invoke($valueHolder81d75, $this, 'initializeProxy', array(), $this->initializerf9ccf) || 1) && $this->valueHolder81d75 = $valueHolder81d75;
    }

    public function isProxyInitialized() : bool
    {
        return null !== $this->valueHolder81d75;
    }

    public function getWrappedValueHolderValue()
    {
        return $this->valueHolder81d75;
    }
}

if (!\class_exists('EntityManager_9a5be93', false)) {
    \class_alias(__NAMESPACE__.'\\EntityManager_9a5be93', 'EntityManager_9a5be93', false);
}
