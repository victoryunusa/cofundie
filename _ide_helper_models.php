<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Adscountry
 *
 * @property int $advertise_id
 * @property string $country
 * @method static \Illuminate\Database\Eloquent\Builder|Adscountry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Adscountry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Adscountry query()
 * @method static \Illuminate\Database\Eloquent\Builder|Adscountry whereAdvertiseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adscountry whereCountry($value)
 */
	class Adscountry extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Adskeyword
 *
 * @property int $advertise_id
 * @property int $term_id
 * @method static \Illuminate\Database\Eloquent\Builder|Adskeyword newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Adskeyword newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Adskeyword query()
 * @method static \Illuminate\Database\Eloquent\Builder|Adskeyword whereAdvertiseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adskeyword whereTermId($value)
 */
	class Adskeyword extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Adsorder
 *
 * @property int $id
 * @property string $invoice_no
 * @property string|null $trx
 * @property int $gateway_id
 * @property int $adsplan_id
 * @property int $user_id
 * @property float|null $amount
 * @property float|null $tax
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Adsorder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Adsorder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Adsorder query()
 * @method static \Illuminate\Database\Eloquent\Builder|Adsorder whereAdsplanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adsorder whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adsorder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adsorder whereGatewayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adsorder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adsorder whereInvoiceNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adsorder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adsorder whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adsorder whereTrx($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adsorder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adsorder whereUserId($value)
 */
	class Adsorder extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Adsplan
 *
 * @property int $id
 * @property string $title
 * @property float $amount
 * @property int $max_clicks
 * @property int $max_impression
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Adsplan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Adsplan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Adsplan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Adsplan whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adsplan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adsplan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adsplan whereMaxClicks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adsplan whereMaxImpression($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adsplan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adsplan whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adsplan whereUpdatedAt($value)
 */
	class Adsplan extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Advertise
 *
 * @property int $id
 * @property int $user_id
 * @property int $adsplan_id
 * @property int $adsorder_id
 * @property string $title
 * @property int $max_clicks
 * @property int $max_impression
 * @property string|null $banners
 * @property string|null $meta
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Advertise newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Advertise newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Advertise query()
 * @method static \Illuminate\Database\Eloquent\Builder|Advertise whereAdsorderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advertise whereAdsplanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advertise whereBanners($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advertise whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advertise whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advertise whereMaxClicks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advertise whereMaxImpression($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advertise whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advertise whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advertise whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advertise whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advertise whereUserId($value)
 */
	class Advertise extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $key
 * @property array|null $value
 * @property string $lang
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Term[] $terms
 * @property-read int|null $terms_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereValue($value)
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Coupon
 *
 * @property int $id
 * @property int|null $plan_id
 * @property string|null $code
 * @property int|null $discount
 * @property int $is_percent
 * @property int $max_limit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PlanOrder[] $orders
 * @property-read int|null $orders_count
 * @property-read \App\Models\Plan|null $plan
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon query()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereIsPercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereMaxLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereUpdatedAt($value)
 */
	class Coupon extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Currency
 *
 * @property int $id
 * @property string $name
 * @property string|null $country_name
 * @property string $code
 * @property float $rate
 * @property string|null $symbol
 * @property string|null $position
 * @property int $status
 * @property int $is_default
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Gateway[] $gateways
 * @property-read int|null $gateways_count
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereCountryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereSymbol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereUpdatedAt($value)
 */
	class Currency extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Faq
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Faq newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq query()
 */
	class Faq extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Gateway
 *
 * @property int $id
 * @property string $name
 * @property string|null $logo
 * @property float $charge
 * @property string $namespace
 * @property float $min_amount
 * @property float $max_amount
 * @property int $is_auto
 * @property int|null $image_accept
 * @property int $test_mode
 * @property int $status
 * @property int $phone_required
 * @property string $data
 * @property int $currency_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Currency $currency
 * @method static \Illuminate\Database\Eloquent\Builder|Gateway newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Gateway newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Gateway query()
 * @method static \Illuminate\Database\Eloquent\Builder|Gateway whereCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gateway whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gateway whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gateway whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gateway whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gateway whereImageAccept($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gateway whereIsAuto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gateway whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gateway whereMaxAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gateway whereMinAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gateway whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gateway whereNamespace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gateway wherePhoneRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gateway whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gateway whereTestMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gateway whereUpdatedAt($value)
 */
	class Gateway extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\KycMethod
 *
 * @property int $id
 * @property string $title
 * @property string $image
 * @property int $image_accept
 * @property int $status
 * @property array|null $fields
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|KycMethod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KycMethod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KycMethod query()
 * @method static \Illuminate\Database\Eloquent\Builder|KycMethod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycMethod whereFields($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycMethod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycMethod whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycMethod whereImageAccept($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycMethod whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycMethod whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycMethod whereUpdatedAt($value)
 */
	class KycMethod extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\KycMethodUser
 *
 * @property int $id
 * @property int $kyc_method_id
 * @property int $user_id
 * @property int $kyc_request_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|KycMethodUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KycMethodUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KycMethodUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|KycMethodUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycMethodUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycMethodUser whereKycMethodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycMethodUser whereKycRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycMethodUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycMethodUser whereUserId($value)
 */
	class KycMethodUser extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\KycRequest
 *
 * @property int $id
 * @property int $user_id
 * @property int $kyc_method_id
 * @property int $status 0 for pending, 1 for approved, 2 for rejected
 * @property string|null $rejected_at
 * @property string|null $note
 * @property string|null $comment
 * @property array|null $data
 * @property array|null $fields
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\KycMethod $method
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|KycRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KycRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KycRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|KycRequest whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycRequest whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycRequest whereFields($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycRequest whereKycMethodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycRequest whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycRequest whereRejectedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycRequest whereUserId($value)
 */
	class KycRequest extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Media
 *
 * @property int $id
 * @property string $url
 * @property string $driver
 * @property string|null $files
 * @property int|null $user_id
 * @property int $is_optimized
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Media newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Media newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Media query()
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereDriver($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereFiles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereIsOptimized($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereUserId($value)
 */
	class Media extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Menu
 *
 * @property int $id
 * @property string $name
 * @property string $position
 * @property string|null $data
 * @property string $lang
 * @property int $status
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu query()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereUpdatedAt($value)
 */
	class Menu extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Option
 *
 * @property int $id
 * @property string $key
 * @property array $value
 * @property string $lang
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Option newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Option newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Option query()
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereValue($value)
 */
	class Option extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Payout
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $payout_method_id
 * @property float|null $amount
 * @property int $charge
 * @property int $rate
 * @property string $currency
 * @property string|null $comment
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PayoutMethod|null $payout_method
 * @method static \Illuminate\Database\Eloquent\Builder|Payout newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payout newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payout query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout wherePayoutMethodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereUserId($value)
 */
	class Payout extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PayoutMethod
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $image
 * @property float|null $min_limit
 * @property float $max_limit
 * @property string|null $delay
 * @property float|null $fixed_charge
 * @property float|null $rate
 * @property float|null $percent_charge
 * @property string|null $currency
 * @property mixed|null $data
 * @property string|null $instruction
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\UserPayoutMethod|null $usermethod
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutMethod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutMethod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutMethod query()
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutMethod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutMethod whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutMethod whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutMethod whereDelay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutMethod whereFixedCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutMethod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutMethod whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutMethod whereInstruction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutMethod whereMaxLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutMethod whereMinLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutMethod whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutMethod wherePercentCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutMethod whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutMethod whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayoutMethod whereUpdatedAt($value)
 */
	class PayoutMethod extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Plan
 *
 * @property int $id
 * @property string $name
 * @property float|null $monthly_price
 * @property float|null $yearly_price
 * @property string $interval
 * @property float $monthly_discount
 * @property float $yearly_discount
 * @property string|null $discount_applied_on
 * @property array|null $features
 * @property int|null $statistics
 * @property int|null $storage
 * @property string|null $tag
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PlanOrder[] $orders
 * @property-read int|null $orders_count
 * @method static \Illuminate\Database\Eloquent\Builder|Plan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Plan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Plan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereDiscountAppliedOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereFeatures($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereMonthlyDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereMonthlyPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereStatistics($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereStorage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereYearlyDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereYearlyPrice($value)
 */
	class Plan extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PlanOrder
 *
 * @property int $id
 * @property string $invoice_no
 * @property int $user_id
 * @property int $plan_id
 * @property int|null $coupon_id
 * @property float|null $amount
 * @property float|null $tax
 * @property string|null $will_expire
 * @property string|null $trx
 * @property int $gateway_id
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Coupon|null $coupon
 * @property-read \App\Models\Gateway $gateway
 * @property-read \App\Models\Plan $plan
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|PlanOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanOrder whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanOrder whereCouponId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanOrder whereGatewayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanOrder whereInvoiceNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanOrder wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanOrder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanOrder whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanOrder whereTrx($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanOrder whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanOrder whereWillExpire($value)
 */
	class PlanOrder extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Podcast
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string|null $thumbnail
 * @property string|null $cover_image
 * @property string|null $description
 * @property string|null $email
 * @property string $status
 * @property string $lang
 * @property string $is_monetized
 * @property int $category_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PodcastCategory $category
 * @method static \Illuminate\Database\Eloquent\Builder|Podcast newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Podcast newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Podcast query()
 * @method static \Illuminate\Database\Eloquent\Builder|Podcast whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Podcast whereCoverImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Podcast whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Podcast whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Podcast whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Podcast whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Podcast whereIsMonetized($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Podcast whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Podcast whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Podcast whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Podcast whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Podcast whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Podcast whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Podcast whereUserId($value)
 */
	class Podcast extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PodcastCategory
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int $status
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|PodcastCategory[] $children
 * @property-read int|null $children_count
 * @property-read PodcastCategory|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Podcast[] $podcasts
 * @property-read int|null $podcasts_count
 * @method static \Illuminate\Database\Eloquent\Builder|PodcastCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PodcastCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PodcastCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|PodcastCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PodcastCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PodcastCategory whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PodcastCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PodcastCategory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PodcastCategory whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PodcastCategory whereUpdatedAt($value)
 */
	class PodcastCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PodcastEpisode
 *
 * @property int $id
 * @property string $title
 * @property string $filepath
 * @property int $duration
 * @property float|null $file_size
 * @property string|null $slug
 * @property int|null $season
 * @property string|null $type
 * @property string $visibility
 * @property int $is_published
 * @property string|null $description
 * @property string|null $image
 * @property mixed|null $tags
 * @property int $is_explicit
 * @property int $podcast_id
 * @property int|null $podcast_episode_id
 * @property-read PodcastEpisode|null $episode
 * @property-read \App\Models\Podcast $podcast
 * @method static \Illuminate\Database\Eloquent\Builder|PodcastEpisode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PodcastEpisode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PodcastEpisode query()
 * @method static \Illuminate\Database\Eloquent\Builder|PodcastEpisode whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PodcastEpisode whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PodcastEpisode whereFileSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PodcastEpisode whereFilepath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PodcastEpisode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PodcastEpisode whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PodcastEpisode whereIsExplicit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PodcastEpisode whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PodcastEpisode wherePodcastEpisodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PodcastEpisode wherePodcastId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PodcastEpisode whereSeason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PodcastEpisode whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PodcastEpisode whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PodcastEpisode whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PodcastEpisode whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PodcastEpisode whereVisibility($value)
 */
	class PodcastEpisode extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Support
 *
 * @property int $id
 * @property int $ticket_no
 * @property string $subject
 * @property string|null $reference_code
 * @property string $priority
 * @property string $type
 * @property string $details
 * @property array $images
 * @property int $status
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SupportMeta[] $meta
 * @property-read int|null $meta_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Support newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Support newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Support query()
 * @method static \Illuminate\Database\Eloquent\Builder|Support whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Support whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Support whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Support whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Support wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Support whereReferenceCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Support whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Support whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Support whereTicketNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Support whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Support whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Support whereUserId($value)
 */
	class Support extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SupportMeta
 *
 * @property int $id
 * @property int $type
 * @property string $comment
 * @property int $support_id
 * @property int $sender_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $sender
 * @property-read \App\Models\Support $support
 * @method static \Illuminate\Database\Eloquent\Builder|SupportMeta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupportMeta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupportMeta query()
 * @method static \Illuminate\Database\Eloquent\Builder|SupportMeta whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupportMeta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupportMeta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupportMeta whereSenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupportMeta whereSupportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupportMeta whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupportMeta whereUpdatedAt($value)
 */
	class SupportMeta extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Tax
 *
 * @property int $id
 * @property string $name
 * @property float $rate
 * @property string|null $type
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Tax newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tax newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tax query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereUpdatedAt($value)
 */
	class Tax extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TemporaryFile
 *
 * @property int $id
 * @property string $folder
 * @property string $filename
 * @property string $driver
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryFile query()
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryFile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryFile whereDriver($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryFile whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryFile whereFolder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryFile whereUpdatedAt($value)
 */
	class TemporaryFile extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Term
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $type
 * @property int $status
 * @property int $featured
 * @property string $lang
 * @property int $comment_status
 * @property \App\Models\TermMeta|null $meta
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TermMeta|null $awesome_awaits_description
 * @property-read \App\Models\TermMeta|null $awesome_awaits_excerpt
 * @property-read \App\Models\TermMeta|null $awesome_awaits_preview
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $blogCategory
 * @property-read int|null $blog_category_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read \App\Models\TermCategory|null $categoriesWithOne
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $category
 * @property-read int|null $category_count
 * @property-read \App\Models\TermMeta|null $description
 * @property-read \App\Models\TermMeta|null $excerpt
 * @property-read \App\Models\TermMeta|null $icon
 * @property-read \App\Models\TermMeta|null $metaDescription
 * @property-read \App\Models\TermMeta|null $metaTag
 * @property-read \App\Models\TermMeta|null $page
 * @property-read \App\Models\TermMeta|null $pageMeta
 * @property-read \App\Models\TermMeta|null $postMeta
 * @property-read \App\Models\TermMeta|null $preview
 * @property-read \App\Models\TermMeta|null $support
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $tags
 * @property-read int|null $tags_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TermCategory[] $termCategories
 * @property-read int|null $term_categories_count
 * @property-read \App\Models\TermMeta|null $termMeta
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TermMeta[] $termMetas
 * @property-read int|null $term_metas_count
 * @property-read \App\Models\TermMeta|null $thumbnail
 * @method static \Illuminate\Database\Eloquent\Builder|Term newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Term newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Term query()
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereCommentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereUpdatedAt($value)
 */
	class Term extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TermCategory
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TermCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TermCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TermCategory query()
 */
	class TermCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TermMeta
 *
 * @property int $id
 * @property int $term_id
 * @property string $key
 * @property string|null $value
 * @method static \Illuminate\Database\Eloquent\Builder|TermMeta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TermMeta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TermMeta query()
 * @method static \Illuminate\Database\Eloquent\Builder|TermMeta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TermMeta whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TermMeta whereTermId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TermMeta whereValue($value)
 */
	class TermMeta extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $uuid
 * @property string|null $name
 * @property string $username
 * @property string|null $phone
 * @property string $email
 * @property string|null $password
 * @property string|null $avatar
 * @property string $role
 * @property float $wallet
 * @property int $status
 * @property array|null $meta
 * @property int|null $plan_id
 * @property string|null $will_expire
 * @property string|null $plan_data
 * @property string|null $ip_address
 * @property \Illuminate\Support\Carbon|null $last_login_at
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $kyc_verified_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read bool $is_pro
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \App\Models\Plan|null $plan
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereKycVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastLoginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePlanData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereWallet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereWillExpire($value)
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

namespace App\Models{
/**
 * App\Models\UserPayoutMethod
 *
 * @property int $id
 * @property int $payout_method_id
 * @property int $user_id
 * @property array|null $payout_infos
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserPayoutMethod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPayoutMethod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPayoutMethod query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPayoutMethod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPayoutMethod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPayoutMethod wherePayoutInfos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPayoutMethod wherePayoutMethodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPayoutMethod whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPayoutMethod whereUserId($value)
 */
	class UserPayoutMethod extends \Eloquent {}
}

