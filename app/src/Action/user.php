<?php
namespace App\Action;
use Illuminate\Database\Eloquent\Model;
use Valitron\Validator;

final class User extends Model
{
    /**
     * Update login 
     *
     * @param  arrray $attributes
     * @return null
     */
    public function update(array $attributes = [], array $options = [])
    {
        $validator = $this->getValidator($attributes);
        if (!$validator->validate()) {
            $messages = [];
            foreach ($validator->errors() as $fieldName => $errors) {
                $messages[] = current($errors);
            }
            $message = implode("\n", $messages);
            throw new \Exception($message);
        }
        return parent::update($attributes);
    }
    
    public function check(array $attributes = [], array $options = [])
    {
        $validator = $this->getValidator($attributes);
        if (!$validator->validate()) {
            $messages = [];
            foreach ($validator->errors() as $fieldName => $errors) {
                $messages[] = current($errors);
            }
            $message = implode("\n", $messages);
            throw new \Exception($message);
        }
        return parent::update($attributes);
    }
    /**
     * Retrieve validator for this entity
     *
     * @param  Array $data Data to be validated
     * @return Validator
     */
    public function getValidator($data)
    {
        $validator = new Validator($data);
        $validator->rule('required', 'username');
        $validator->rule('required', 'password');
        $validator->rule('lengthBetween', 'username', 1, 100);
        $validator->labels([
            'username' => 'Username',
        ]);
        
        return $validator;
    }
}
