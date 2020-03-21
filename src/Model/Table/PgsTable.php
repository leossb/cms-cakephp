<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Pgs Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\PgsTable&\Cake\ORM\Association\BelongsTo $ParentPgs
 * @property \App\Model\Table\PgsTable&\Cake\ORM\Association\HasMany $ChildPgs
 *
 * @method \App\Model\Entity\Pg get($primaryKey, $options = [])
 * @method \App\Model\Entity\Pg newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Pg[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Pg|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pg saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pg patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Pg[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Pg findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class PgsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('pgs');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Tree');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('ParentPgs', [
            'className' => 'Pgs',
            'foreignKey' => 'parent_id',
        ]);
        $this->hasMany('ChildPgs', [
            'className' => 'Pgs',
            'foreignKey' => 'parent_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 191)
            ->requirePresence('slug', 'create')
            ->notEmptyString('slug');

        $validator
            ->integer('name')
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->integer('body')
            ->allowEmptyString('body');

        $validator
            ->integer('published')
            ->allowEmptyString('published');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['parent_id'], 'ParentPgs'));

        return $rules;
    }
}
