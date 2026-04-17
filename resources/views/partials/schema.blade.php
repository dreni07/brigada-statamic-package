@foreach($schema->blocks as $block)
<script type="application/ld+json">{!! $block !!}</script>
@endforeach
