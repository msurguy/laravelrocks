<?php

namespace Tricks;

use Illuminate\Database\Eloquent\Model;
use McCool\LaravelAutoPresenter\PresenterInterface;

class Trick extends Model implements PresenterInterface
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tricks';

	/**
	 * The relations to eager load on every query.
	 *
	 * @var array
	 */
	protected $with = [ 'tags', 'categories', 'user' ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['last_updated_at'];

    public function getPresenter()
    {
        return 'Tricks\Presenters\TrickPresenter';
    }

	/**
	 * Query the tricks' votes.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function votes()
	{
		return $this->belongsToMany('Tricks\User', 'votes');
	}

	/**
	 * Query the user that posted the trick.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
    {
        return $this->belongsTo('Tricks\User');
    }

    /**
     * Query the tags under which the trick was posted.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
	public function tags()
	{
		return $this->belongsToMany('Tricks\Tag');
	}

	/**
	 * Query the categories under which the trick was posted.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function categories()
	{
		return $this->belongsToMany('Tricks\Category');
	}
}
