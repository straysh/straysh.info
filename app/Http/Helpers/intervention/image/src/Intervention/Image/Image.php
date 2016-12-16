<?php

namespace Intervention\Image;

/**
 * @method Image backup(string $name = 'default')                                                                                                     Backups current image state as fallback for reset method under an optional name. Overwrites older state on every call, unless a different name is passed.
 * @method Image blur(integer $amount = 1)                                                                                                            Apply a gaussian blur filter with a optional amount on the current image. Use values between 0 and 100.
 * @method Image brightness(integer $level)                                                                                                           Changes the brightness of the current image by the given level. Use values between -100 for min. brightness. 0 for no change and +100 for max. brightness.
 * @method Image cache(\Closure $callback, integer $lifetime = null, boolean $returnObj = false)                                                      Method to create a new cached image instance from a Closure callback. Pass a lifetime in minutes for the callback and decide whether you want to get an Intervention Image instance as return value or just receive the image stream.
 * @method Image canvas(integer $width, integer $height, mixed $bgcolor = null)                                                                       Factory method to create a new empty image instance with given width and height. You can define a background-color optionally. By default the canvas background is transparent.
 * @method Image circle(integer $radius, integer $x, integer $y, \Closure $callback = null)                                                           Draw a circle at given x, y, coordinates with given radius. You can define the appearance of the circle by an optional closure callback.
 * @method Image colorize(integer $red, integer $green, integer $blue)                                                                                Change the RGB color values of the current image on the given channels red, green and blue. The input values are normalized so you have to include parameters from 100 for maximum color value. 0 for no change and -100 to take out all the certain color on the image.
 * @method Image contrast(integer $level)                                                                                                             Changes the contrast of the current image by the given level. Use values between -100 for min. contrast 0 for no change and +100 for max. contrast.
 * @method Image crop(integer $width, integer $height, integer $x = null, integer $y = null)                                                          Cut out a rectangular part of the current image with given width and height. Define optional x, y coordinates to move the top-left corner of the cutout to a certain position.
 * @method void  destroy()                                                                                                                            Frees memory associated with the current image instance before the PHP script ends. Normally resources are destroyed automatically after the script is finished.
 * @method Image ellipse(integer $width, integer $height, integer $x, integer $y, \Closure $callback = null)                                          Draw a colored ellipse at given x, y, coordinates. You can define width and height and set the appearance of the circle by an optional closure callback.
 * @method mixed exif(string $key = null)                                                                                                             Read Exif meta data from current image.
 * @method mixed iptc(string $key = null)                                                                                                             Read Iptc meta data from current image.
 * @method Image fill(mixed $filling, integer $x = null, integer $y = null)                                                                           Fill current image with given color or another image used as tile for filling. Pass optional x, y coordinates to start at a certain point.
 * @method Image flip(mixed $mode = 'h')                                                                                                              Mirror the current image horizontally or vertically by specifying the mode.
 * @method Image fit(integer $width, integer $height = null, \Closure $callback = null, string $position = 'center')                                  Combine cropping and resizing to format image in a smart way. The method will find the best fitting aspect ratio of your given width and height on the current image automatically, cut it out and resize it to the given dimension. You may pass an optional Closure callback as third parameter, to prevent possible upsizing and a custom position of the cutout as fourth parameter.
 * @method Image gamma(float $correction)                                                                                                             Performs a gamma correction operation on the current image.
 * @method Image greyscale()                                                                                                                          Turns image into a greyscale version.
 * @method Image heighten(integer $height, \Closure $callback = null)                                                                                 Resizes the current image to new height, constraining aspect ratio. Pass an optional Closure callback as third parameter, to apply additional constraints like preventing possible upsizing.
 * @method Image insert(mixed $source, string $position = 'top-left', integer $x = 0, integer $y = 0)                                                 Paste a given image source over the current image with an optional position and a offset coordinate. This method can be used to apply another image as watermark because the transparency values are maintained.
 * @method Image interlace(boolean $interlace = true)                                                                                                 Determine whether an image should be encoded in interlaced or standard mode by toggling interlace mode with a boolean parameter. If an JPEG image is set interlaced the image will be processed as a progressive JPEG.
 * @method Image invert()                                                                                                                             Reverses all colors of the current image.
 * @method Image limitColors(integer $count, mixed $matte = null)                                                                                     Method converts the existing colors of the current image into a color table with a given maximum count of colors. The function preserves as much alpha channel information as possible and blends transarent pixels against a optional matte color.
 * @method Image line(integer $x1, integer $y1, integer $x2, integer $y2, \Closure $callback = null)                                                  Draw a line from x, y point 1 to x, y point 2 on current image. Define color and / or width of line in an optional Closure callback.
 * @method Image make(mixed $source)                                                                                                                  Universal factory method to create a new image instance from source, which can be a filepath, a GD image resource, an Imagick object or a binary image data.
 * @method Image mask(mixed $source, boolean $mask_with_alpha)                                                                                        Apply a given image source as alpha mask to the current image to change current opacity. Mask will be resized to the current image size. By default a greyscale version of the mask is converted to alpha values, but you can set mask_with_alpha to apply the actual alpha channel. Any transparency values of the current image will be maintained.
 * @method Image opacity(integer $transparency)                                                                                                       Set the opacity in percent of the current image ranging from 100% for opaque and 0% for full transparency.
 * @method Image orientate()                                                                                                                          This method reads the EXIF image profile setting 'Orientation' and performs a rotation on the image to display the image correctly.
 * @method mixed pickColor(integer $x, integer $y, string $format = 'array')                                                                          Pick a color at point x, y out of current image and return in optional given format.
 * @method Image pixel(mixed $color, integer $x, integer $y)                                                                                          Draw a single pixel in given color on x, y position.
 * @method Image pixelate(integer $size)                                                                                                              Applies a pixelation effect to the current image with a given size of pixels.
 * @method Image polygon(array $points, \Closure $callback = null)                                                                                    Draw a colored polygon with given points. You can define the appearance of the polygon by an optional closure callback.
 * @method Image rectangle(integer $x1, integer $y1, integer $x2, integer $y2, \Closure $callback = null)                                             Draw a colored rectangle on current image with top-left corner on x, y point 1 and bottom-right corner at x, y point 2. Define the overall appearance of the shape by passing a Closure callback as an optional parameter.
 * @method Image reset(string $name = 'default')                                                                                                      Resets all of the modifications to a state saved previously by backup under an optional name.
 * @method Image resize(integer $width, integer $height, \Closure $callback = null)                                                                   Resizes current image based on given width and / or height. To contraint the resize command, pass an optional Closure callback as third parameter.
 * @method Image resizeCanvas(integer $width, integer $height, string $anchor = 'center', boolean $relative = false, mixed $bgcolor = '#000000')      Resize the boundaries of the current image to given width and height. An anchor can be defined to determine from what point of the image the resizing is going to happen. Set the mode to relative to add or subtract the given width or height to the actual image dimensions. You can also pass a background color for the emerging area of the image.
 * @method mixed response(string $format = null, integer $quality = 90)                                                                               Sends HTTP response with current image in given format and quality.
 * @method Image rotate(float $angle, string $bgcolor = '#000000')                                                                                    Rotate the current image counter-clockwise by a given angle. Optionally define a background color for the uncovered zone after the rotation.
 * @method Image sharpen(integer $amount = 10)                                                                                                        Sharpen current image with an optional amount. Use values between 0 and 100.
 * @method Image text(string $text, integer $x = 0, integer $y = 0, \Closure $callback = null)                                                        Write a text string to the current image at an optional x, y basepoint position. You can define more details like font-size, font-file and alignment via a callback as the fourth parameter.
 * @method Image trim(string $base = 'top-left', array $away = array('top', 'bottom', 'left', 'right'), integer $tolerance = 0, integer $feather = 0) Trim away image space in given color. Define an optional base to pick a color at a certain position and borders that should be trimmed away. You can also set an optional tolerance level, to trim similar colors and add a feathering border around the trimed image.
 * @method Image widen(integer $width, \Closure $callback = null)                                                                                     Resizes the current image to new width, constraining aspect ratio. Pass an optional Closure callback as third parameter, to apply additional constraints like preventing possible upsizing.
 */
class Image extends File
{
	/**
	 * Instance of current image driver
	 *
	 * @var AbstractDriver
	 */
	protected $driver;

	/**
	 * Image resource/object of current image processor
	 *
	 * @var mixed
	 */
	protected $core;

	/**
	 * Array of Image resource backups of current image processor
	 *
	 * @var array
	 */
	protected $backups = array();

	/**
	 * Last image encoding result
	 *
	 * @var string
	 */
	public $encoded = '';

	/**
	 * Creates a new Image instance
	 *
	 * @param AbstractDriver $driver
	 * @param mixed          $core
	 */
	public function __construct(AbstractDriver $driver = null, $core = null)
	{
		$this->driver = $driver;
		$this->core = $core;
	}

	/**
	 * Magic method to catch all image calls
	 * usually any AbstractCommand
	 *
	 * @param  string $name
	 * @param  Array  $arguments
	 *
	 * @return mixed
	 */
	public function __call($name, $arguments)
	{
		$command = $this->driver->executeCommand($this, $name, $arguments);
		return $command->hasOutput() ? $command->getOutput() : $this;
	}

	/**
	 * Starts encoding of current image
	 *
	 * @param  string  $format
	 * @param  integer $quality
	 *
	 * @return Image
	 */
	public function encode($format = null, $quality = 90)
	{
		return $this->driver->encode($this, $format, $quality);
	}

	public function getExifJson()
	{
		$exif = $this->getCore()->getImageProperties();
		if(isset($exif['date:create'])) unset($exif['date:create']);
		if(isset($exif['date:modify'])) unset($exif['date:modify']);
		if(!empty($exif)) return serialize($exif);
		return NULL;
	}

	/**
	 * 获取图片的 SHA-256 摘要值
	 * @return string
	 */
	public function getImageSignature()
	{
		return $this->getCore()->getImageSignature();
	}

	/**
	 * Saves encoded image in filesystem
	 *
	 * @param  string  $path
	 * @param  integer $quality
	 *
	 * @return Image
	 */
	public function save($path = null, $quality = null)
	{
		$path = is_null($path) ? $this->basePath() : $path;

		if (is_null($path))
		{
			throw new Exception\NotWritableException(
				"Can't write to undefined path."
			);
		}

		$data = $this->encode(pathinfo($path, PATHINFO_EXTENSION), $quality);
		$saved = @file_put_contents($path, $data);

		if ($saved === false)
		{
			throw new Exception\NotWritableException(
				"Can't write image data to path ({$path})"
			);
		}

		// set new file info
		$this->setFileInfoFromPath($path);

		return $this;
	}

	/**
	 * Runs a given filter on current image
	 *
	 * @param  Filters\FilterInterface $filter
	 *
	 * @return Image
	 */
	public function filter(Filters\FilterInterface $filter)
	{
		return $filter->applyFilter($this);
	}

	/**
	 * Returns current image driver
	 *
	 * @return \Intervention\Image\AbstractDriver
	 */
	public function getDriver()
	{
		return $this->driver;
	}

	/**
	 * Sets current image driver
	 * @param AbstractDriver $driver
	 * @return $this
	 */
	public function setDriver(AbstractDriver $driver)
	{
		$this->driver = $driver;

		return $this;
	}

	/**
	 * Returns current image resource/obj
	 *
	 * @return mixed
	 */
	public function getCore()
	{
		return $this->core;
	}

	/**
	 * Sets current image resource
	 * @param mixed $core
	 * @return $this
	 */
	public function setCore($core)
	{
		$this->core = $core;

		return $this;
	}

	/**
	 * Returns current image backup
	 *
	 * @param string $name
	 *
	 * @return mixed
	 */
	public function getBackup($name = null)
	{
		$name = is_null($name) ? 'default' : $name;

		if (!$this->backupExists($name))
		{
			throw new Exception\RuntimeException(
				"Backup with name ({$name}) not available. Call backup() before reset()."
			);
		}

		return $this->backups[$name];
	}

	/**
	 * Returns all backups attached to image
	 *
	 * @return array
	 */
	public function getBackups()
	{
		return $this->backups;
	}

	/**
	 * Sets current image backup
	 *
	 * @param mixed  $resource
	 * @param string $name
	 *
	 * @return self
	 */
	public function setBackup($resource, $name = null)
	{
		$name = is_null($name) ? 'default' : $name;

		$this->backups[$name] = $resource;

		return $this;
	}

	/**
	 * Checks if named backup exists
	 *
	 * @param  string $name
	 *
	 * @return bool
	 */
	private function backupExists($name)
	{
		return array_key_exists($name, $this->backups);
	}

	/**
	 * Checks if current image is already encoded
	 *
	 * @return boolean
	 */
	public function isEncoded()
	{
		return !is_null($this->encoded);
	}

	/**
	 * Returns encoded image data of current image
	 *
	 * @return string
	 */
	public function getEncoded()
	{
		return $this->encoded;
	}

	/**
	 * Sets encoded image buffer
	 * @param string $value
	 * @return $this
	 */
	public function setEncoded($value)
	{
		$this->encoded = $value;

		return $this;
	}

	/**
	 * Calculates current image width
	 *
	 * @return integer
	 */
	public function getWidth()
	{
		return $this->getSize()->width;
	}

	/**
	 * Alias of getWidth()
	 *
	 * @return integer
	 */
	public function width()
	{
		return $this->getWidth();
	}

	/**
	 * Calculates current image height
	 *
	 * @return integer
	 */
	public function getHeight()
	{
		return $this->getSize()->height;
	}

	/**
	 * Alias of getHeight
	 *
	 * @return integer
	 */
	public function height()
	{
		return $this->getHeight();
	}

	/**
	 * Reads mime type
	 *
	 * @return string
	 */
	public function mime()
	{
		return $this->mime;
	}

	/**
	 * Get fully qualified path to image
	 *
	 * @return string
	 */
	public function basePath()
	{
		if ($this->dirname && $this->basename)
		{
			return ($this->dirname . '/' . $this->basename);
		}

		return null;
	}

	/**
	 * Returns encoded image data in string conversion
	 *
	 * @return string
	 */
	public function __toString()
	{
		return $this->encoded;
	}

	/**
	 * Cloning an image
	 */
	public function __clone()
	{
		$this->core = $this->driver->cloneCore($this->core);
	}
}
